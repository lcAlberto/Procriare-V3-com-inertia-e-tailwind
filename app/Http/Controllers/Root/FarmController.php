<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Http\Requests\FarmRequest;
use App\Models\Farm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class FarmController extends Controller
{
    private $model = null;

    public function __construct()
    {
        $this->model = new Farm();
        $this->user = new User();
    }

    public function index()
    {
//        dd($this->user->farm()->get());
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
//        $user = current_user()->farm->users()->create($data);
        $farm = $this->user->farm()->create($data);


//        dd($data);
//        $this->model->create();
        return Redirect::route('root.farms.index');
    }

    public function edit($id)
    {

    }

    public function getUsers()
    {
        return auth()->user()->can('users create') ?
             User::query()
                ->where('is_owner', true)
                ->select('name as label', 'id as code')
                ->pluck('label', 'code')
        : [];
    }
}
