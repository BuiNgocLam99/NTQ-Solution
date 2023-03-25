<?php

namespace App\Repositories\Attribute;

interface AttributeRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function firstOrCreate($name);

    public function findAllId();

}
