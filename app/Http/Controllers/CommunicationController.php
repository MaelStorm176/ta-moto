<?php

namespace App\Http\Controllers;

use App\Events\CommunicationMessagePosted;
use App\Models\Communication;
use App\Models\ForumChannel;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;

class CommunicationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $consultant_checked = $request->get('consultant');
        $incoming_checked = $request->get('incoming');
        $outgoing_checked = $request->get('outgoing');
        if ($consultant_checked) {
            $consultant_role = Role::where('name', 'consultant')->first();
        }else{
            $consultant_role = Role::where('name', 'user')->first();
        }
        $consultants = User::query()
            ->where('role_id', $consultant_role->id)
            ->when($search, static function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });

        if ($outgoing_checked && !$incoming_checked) {
            $consultants->whereHas('communications', static function ($query) {
                $query->where('sender_id', auth()->user()->id);
            });
        }elseif ($outgoing_checked && $incoming_checked) {
            $consultants->whereHas('communications', static function ($query) {
                $query->where('sender_id', auth()->user()->id);
            })->orWhereHas('sentCommunications', static function ($query) {
                $query->where('receiver_id', auth()->user()->id);
            });
        }elseif (!$outgoing_checked && $incoming_checked) {
            $consultants->whereHas('sentCommunications', static function ($query) {
                $query->where('receiver_id', auth()->user()->id);
            });
        }



        $consultants = $consultants->paginate(10);
        return view('communication.index', compact('consultants'));
    }

    public function sendRequest(User $receveiver): RedirectResponse
    {
        if ($receveiver->communications()->where('sender_id', auth()->user()->id)->exists()) {
            return redirect()->route('communication.index')->with('error', 'Vous avez déjà envoyé une demande à ce consultant');
        }
        $receveiver->communications()->create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $receveiver->id,
            'accepted' => false,
        ]);

        $notification = new Notification();
        $notification->user_id = $receveiver->id;
        $notification->title = 'Nouvelle demande de communication';
        $notification->content = 'Vous avez une nouvelle demande de communication de la part de ' . auth()->user()->name;
        $notification->expired_at = now()->addDays(10);
        $notification->save();

        return back()->with('success', 'Demande envoyée avec succès');
    }

    public function acceptRequest(Communication $communication): RedirectResponse
    {
        if ($communication->receiver_id !== auth()->user()->id) {
            return redirect()->route('communication.index')->with('error', 'Vous n\'êtes pas autorisé à accepter cette demande');
        }
        $communication->update([
            'accepted' => true,
        ]);
        return back()->with('success', 'Demande acceptée avec succès');
    }

    public function refuseRequest(Communication $communication): RedirectResponse
    {
        if ($communication->receiver_id !== auth()->user()->id) {
            return redirect()->route('communication.index')->with('error', 'Vous n\'êtes pas autorisé à refuser cette demande');
        }
        $communication->update([
            'accepted' => false,
        ]);
        return back()->with('success', 'Demande refusée avec succès');
    }

    public function show(Communication $communication)
    {
        if ($communication->accepted === false) {
            return redirect()->route('communication.index')->with('error', 'Cette communication n\'est pas encore acceptée');
        }
        $opposite_user = $communication->sender_id === auth()->user()->id ? $communication->receiver : $communication->sender;
        return view('communication.showMessages', compact('communication', 'opposite_user'));
    }

    public function sendMessage(Request $request, Communication $communication): JsonResponse|RedirectResponse
    {
        $request->validate([
            'message' => 'required|string|min:3|max:1000',
        ]);
        $message = $communication->messages()->create([
            'created_by' => auth()->id(),
            'communication_id' => $communication->id,
            'message' => $request->get('message'),
        ]);

        broadcast(new CommunicationMessagePosted($message));

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Message posted successfully',
                'data' => $message
            ]);
        }
        return redirect()->route('communication.show', $communication)->with('success', 'Message envoyé avec succès');
    }
}
