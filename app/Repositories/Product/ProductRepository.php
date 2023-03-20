<?php

namespace App\Repositories\Product;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all()
    {
        $products = $this->product->paginate(10);
        foreach ($products as $product) {
            $product['gallery_images'] = json_decode($product['gallery_images']);
        }
        return $products;
    }

    public function create(array $data)
    {
        return $this->product->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->product->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->product->find($id)->delete();
    }

    public function find($id)
    {
        return $this->product->find($id);
    }

    public function removeMainImage($id)
    {
        $product = $this->find($id);
        $product->main_image = 'hehe';
        $product->save();
        return $this->product->find($id);
    }
}
