<?php

namespace App\Repositories\AttributeValue;

use App\Models\AttributeValue;

class AttributeValueRepository implements AttributeValueRepositoryInterface
{
    protected $model;

    public function __construct(AttributeValue $model)
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

    public function findProductCode($code)
    {
        return $this->model->where('product_code', $code)->first();
    }
}
