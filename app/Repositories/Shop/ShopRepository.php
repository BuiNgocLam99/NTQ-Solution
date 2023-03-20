<?php

namespace App\Repositories\Shop;

use App\Models\Shop;

class ShopRepository implements ShopRepositoryInterface
{
    protected $shop;

    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }

    public function all()
    {
        $shops = $this->shop->paginate(10);
        return $shops;
    }

    public function create(array $data)
    {
        return $this->shop->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->shop->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->shop->find($id)->delete();
    }

    public function find($id)
    {
        return $this->shop->find($id);
    }
}
