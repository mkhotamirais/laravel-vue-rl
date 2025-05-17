<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Rental;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $rentals = Rental::filter(request(['rentalcat']))
            ->orderByRaw("
                CASE 
                    WHEN category = 'Lepas Kunci' AND price = (SELECT MIN(price) FROM rentals WHERE category = 'Lepas Kunci') THEN 1
                    WHEN category = 'Lepas Kunci' THEN 2
                    WHEN category = 'Include Driver' AND price = (SELECT MIN(price) FROM rentals WHERE category = 'Include Driver') THEN 3
                    WHEN category = 'Include Driver' THEN 4
                    ELSE 5
                END
            ")
            ->paginate(4);

        $msg = session('msg');
        return inertia('Rental/Index', compact('rentals', 'msg'));
    }

    public function create(Request $request)
    {
        return inertia('Rental/Create');
    }

    public function store(Request $request)
    {
        // Validate
        $fields = $request->validate([
            'name' => 'required|max:255|unique:rentals',
            'price' => 'required|integer',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'policy' => 'required',
            'information' => 'nullable',
            'category' => 'required|in:lepas_kunci,include_driver',
        ]);

        $fields['slug'] = Str::slug($fields['name']);

        if ($request->hasFile('banner')) {
            $fields['banner'] = Storage::disk('public')->put('images/rentals', $request->banner);
        }

        $request->user()->rentals()->create($fields);

        return redirect()->route('sewa-mobil.index')->with('msg', 'Data berhasil ditambahkan');
    }

    public function show(Rental $rental)
    {
        $otherRentals = Rental::where('id', '!=', $rental->id)->get();
        $latestBlogs = Blog::latest()->take(4)->get();
        return inertia('Rental/Show', compact('rental', 'otherRentals', 'latestBlogs'));
    }

    public function edit(Rental $rental)
    {
        return inertia('Rental/Edit', compact('rental'));
    }

    public function update(Request $request, Rental $rental)
    {
        // Validate
        $fields = $request->validate([
            'name' => 'required|max:255|unique:rentals,name,' . $rental->id,
            'price' => 'required|integer',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'policy' => 'required',
            'information' => 'nullable',
            'category' => 'required|in:lepas_kunci,include_driver',
        ]);

        $fields['slug'] = Str::slug($fields['name']);

        if ($request->hasFile('banner')) {
            if ($rental->banner) {
                Storage::disk('public')->delete($rental->banner);
            }
            $fields['banner'] = Storage::disk('public')->put('images/rentals', $request->banner);
        } else {
            $fields['banner'] = $rental->banner;
        }

        $rental->update($fields);
        return redirect()->route('sewa-mobil.index')->with('msg', 'Data berhasil diupdate');
    }

    public function destroy(Rental $rental)
    {
        if ($rental->banner) {
            Storage::disk('public')->delete($rental->banner);
        }
        $rental->delete();
        return redirect()->route('sewa-mobil.index')->with('msg', 'Data berhasil dihapus');
    }
}
