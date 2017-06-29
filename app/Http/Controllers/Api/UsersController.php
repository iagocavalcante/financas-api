<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;    
    }
    public function store(UsersRequest $request)
    {
        $user = $this->repository->create($request->all());
        return response()->json($user, 200);
    }
}
