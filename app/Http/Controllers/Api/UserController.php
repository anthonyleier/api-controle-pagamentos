<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller {
    public function index() {
        $users = User::paginate();
        return UserResource::collection($users);
    }

    public function store(StoreUpdateUserRequest $request) {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return new UserResource($user);
    }

    public function show(string $id) {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }
}
