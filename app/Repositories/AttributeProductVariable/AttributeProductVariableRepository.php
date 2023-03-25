<?php

namespace App\Repositories\AttributeProductVariable;

use App\Models\AttributeProductVariable;

class AttributeProductVariableRepository implements AttributeProductVariableRepositoryInterface
{
    protected $model;

    public function __construct(AttributeProductVariable $model)
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
}
