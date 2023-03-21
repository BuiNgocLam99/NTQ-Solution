<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function all();

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);

    public function find($id);

    public function findByEmail($email);
}