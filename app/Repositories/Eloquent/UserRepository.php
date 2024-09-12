<?php

namespace App\Repositories\Eloquent;

use App\Enums\UserStatusEnum;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;

final class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    // admin
    public function getUsers(?string $filter)
    {
        $query = [];
        if ($filter) {
            $query = [['name', 'like', '%' . $filter . '%']];
        }
        return $this->model->where($query)
            ->whereNot('status', UserStatusEnum::DELETED->value)->paginate(25);
    }
    public function findByEmail(string $email): mixed
    {
        return $this->model->where([
            ['email', $email],
            ['status', '!=', UserStatusEnum::DELETED->value]
        ])->firstOrFail();
    }


    public function users(): object
    {
        return $this->model->whereNot('status', UserStatusEnum::DELETED->value)->paginate(50);
    }

    public function findById(int $id)
    {
        return $this->model->whereNot('status', UserStatusEnum::DELETED->value)->findOrFail($id);
    }
}
