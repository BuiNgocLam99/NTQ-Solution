<?php

namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function all();

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);

    public function find($id);
}