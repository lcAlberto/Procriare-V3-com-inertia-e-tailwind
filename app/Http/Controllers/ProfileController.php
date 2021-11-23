<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return Inertia::render('Shared/MyProfile/MyProfile', $user);
    }

    public function update(Request $request)
    {
        dd($request->all());
    }
}
