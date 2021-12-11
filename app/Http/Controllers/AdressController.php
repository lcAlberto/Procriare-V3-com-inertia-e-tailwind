<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class AdressController extends Controller
{
    public function getStates()
    {
        $states = State::all();
        dd($states);
        return $states;
    }
}
