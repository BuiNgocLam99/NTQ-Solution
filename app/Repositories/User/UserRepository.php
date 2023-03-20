<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('created_at', 'desc')->paginate(10);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function login($email, $password)
    {
        // if (User::guard('')->attempt(['email' => $email, 'password' => $password])) {
        //     return true;
        // }
        return false;
    }
}
