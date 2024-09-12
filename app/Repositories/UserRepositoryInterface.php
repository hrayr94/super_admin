<?php

namespace App\Repositories;


interface UserRepositoryInterface extends BaseRepositoryInterface
{
    //admin
    public function getUsers(?string $filter);

    public function findById(int $id);
    public function findByEmail(string $email);
    public function users(): object;
}
