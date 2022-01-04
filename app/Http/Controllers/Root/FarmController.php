<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Http\Requests\FarmRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FarmController extends Controller
{
    private $user = [];

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function index()
    {
        $user = auth()->user();
        return Inertia::render('Root/Farms/index', $user);
    }

    public function create()
    {
        $user = auth()->user();
        return Inertia::render('Root/Farms/create', $user);
    }

    public function store(FarmRequest $request)
    {
        $data = $request->validated();
    }

    public function edit($id)
    {

    }
}
