<?php

namespace App\Repositories\Attribute;

use App\Models\Attribute;

class AttributeRepository implements AttributeRepositoryInterface
{
    protected $model;

    public function __construct(Attribute $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findByName($name)
    {
        return $this->model->where('name', $name)->first();
    }

    public function firstOrCreate($name)
    {
        return $this->model->firstOrCreate(['name' => $name]);
    }

    public function findAllId()
    {
        $names = ['quantity', 'size', 'image', 'color'];
        
        return $this->model->whereIn('name', $names)->get();
    }
}
