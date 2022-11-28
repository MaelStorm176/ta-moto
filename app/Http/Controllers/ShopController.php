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

    public function show(Motorbike $motorbike)
    {
        $relatedMotorbikes = Motorbike::where('category', $motorbike->category)
            ->where('id', '!=', $motorbike->id)
            ->limit(3)
            ->get();
        return view('shop.show', compact('motorbike', 'relatedMotorbikes'));
    }

    public function showCategory(MotorbikeCategory $category)
    {
        $categories = MotorbikeCategory::all();
        $motorbikes = Motorbike::where('price', '>', 0)
            ->where('category', $category->id)
            ->orderBy('price', 'asc')
            ->limit(50)
            ->get();
        return view('shop.index', compact('categories', 'motorbikes'));
    }
}
