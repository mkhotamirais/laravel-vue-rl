<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        return inertia('Rental/Index');
    }

    // public function create()
    // {
    //     return inertia('Rental/Create');
    // }

    // public function show($id)
    // {
    //     return inertia('Rental/Show', ['id' => $id]);
    // }

    // public function edit($id)
    // {
    //     return inertia('Rental/Edit', ['id' => $id]);
    // }
}
