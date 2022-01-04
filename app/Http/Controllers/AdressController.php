<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class AdressController extends Controller
{
    public function getStates(): \Illuminate\Support\Collection
    {
        return State::query()
            ->select('name as label', 'id as code')
            ->pluck('label', 'code');
    }

    public function getCities(State $state): \Illuminate\Support\Collection
    {
        return collect($state->cities)
            ->pluck('name', 'id');

    }
}
