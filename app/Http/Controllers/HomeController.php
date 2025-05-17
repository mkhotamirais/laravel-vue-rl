<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Rental;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $popularDestinations = Blog::whereHas("blogcat", function ($query) {
            $query->where("name", "=", "destinasi populer");
        })->take(4)->get();
        $rentals = Rental::latest()->take(4)->get();
        $blogs = Blog::latest()->take(4)->get();
        return inertia('Home', compact('rentals', 'blogs', 'popularDestinations'));
    }

    public function search(Request $request)
    {
        $rentalResults = Rental::latest()
            ->filter(request(['q']))
            ->get();

        $blogResults = Blog::with('blogcat:id,name,slug')
            ->filter(request(['q']))
            ->latest()
            ->get();

        return inertia('SearchResult', compact('rentalResults', 'blogResults'));
    }
}
