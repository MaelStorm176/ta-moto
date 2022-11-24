<?php

namespace App\Http\Controllers;

use App\Models\Motorbike;
use App\Models\MotorbikeCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $categories = MotorbikeCategory::all();
        $motorbikes = Motorbike::where('price', '>', 0)
            ->orderBy('price', 'asc')
            ->limit(50)
            ->get();
        return view('shop.index', compact('categories', 'motorbikes'));
    }

    public function show($slug)
    {
        return view('shop.show');
    }
}
