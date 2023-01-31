<?php

namespace App\Http\Controllers;

use App\Events\CommunicationMessagePosted;
use App\Models\Communication;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;

class CommunicationController extends Controller
{
    public function index()
    {
        $consultant_role = Role::where('name', 'consultant')->first();
        $consultants = User::where('role_id', $consultant_role->id)->paginate(10,[
            'id',
            'name',
            'avatar',
            'email',
        ]);
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
        return redirect()->route('communication.index')->with('success', 'Demande envoyée avec succès');
    }

    public function acceptOrRefuseRequest(Request $request, Communication $communication): RedirectResponse
    {
        $request->validate([
            'accepted' => 'required|boolean',
        ]);

        $communication->update([
            'accepted' => $request->get('accepted'),
        ]);
        return redirect()->route('communication.index')->with('success', 'Demande acceptée avec succès');
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
