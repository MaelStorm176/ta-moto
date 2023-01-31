<?php

namespace App\Http\Controllers;

use App\Models\Motorbike;
use App\Models\MotorbikeCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() : View
    {
        $categories = MotorbikeCategory::all();
        $motos = Motorbike::inRandomOrder()->limit(3)->get();
        return view('home', compact('categories', 'motos'));
    }

    public function about() : View
    {
        return view('company.about');
    }

    public function contact(Request $request) : View
    {
        if ($request->isMethod('post')){
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
            ]);
            $data = $request->all();
            $data['message'] = nl2br($data['message']);
            \Mail::send('emails.contact', $data, static function ($message) use ($data) {
                $message->from($data['email'], $data['name']);
                $message->to('mael.jamin@gmail.com', 'Mael Jamin')->subject('Contact');
            });
        }
        return view('company.contact');
    }

    public function terms() : View
    {
        return view('company.terms');
    }

    public function privacy() : View
    {
        return view('company.privacy');
    }

    public function cookies() : View
    {
        return view('company.cookies');
    }

}
