<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Admin\FilterUserRequest;
use App\Http\Requests\User\Admin\StoreUserRequest;
use App\Http\Requests\User\Admin\UpdateUserRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    public function index(FilterUserRequest $request): SuccessResource
    {
        $filter = $request->input('name');
        $users = $this->userRepository->getUsers($filter);
        return SuccessResource::make([
            'data' => UserResource::collection($users),
            'message' => 'success'
        ]);
    }

    public function store(StoreUserRequest $request): SuccessResource
    {
        $user = $this->userRepository->create($request->validated());

        return SuccessResource::make([
            'data' => $user
        ]);
    }

    public function show(User $user): SuccessResource
    {
        return SuccessResource::make([
            'data' => UserResource::make($user),
            'message' => 'success'
        ]);
    }

    public function update(User $user, UpdateUserRequest $request): SuccessResource
    {
        $user->update($request->validated());

        return SuccessResource::make([
            'data' => $user
        ]);
    }

    public function destroy(User $user): SuccessResource
    {
        $user->update(['status' => UserStatusEnum::DELETED->value]);

        return SuccessResource::make([
            'message' => 'success',
        ]);
    }
}
