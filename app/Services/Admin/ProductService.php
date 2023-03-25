<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\ProductFormRequest;
use App\Models\Attribute;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Repositories\AttributeProductVariable\AttributeProductVariableRepositoryInterface;
use App\Repositories\AttributeValue\AttributeValueRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Shop\ShopRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\ProductVariable\ProductVariableRepositoryInterface;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class ProductService
{
    protected $productRepository;
    protected $shopRepository;
    protected $categoryRepository;
    protected $productVariableRepository;
    protected $attributeRepository;
    protected $attributeValueRepository;
    protected $attributeProductVariableRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ShopRepositoryInterface $shopRepository,
        CategoryRepositoryInterface $categoryRepository,
        ProductVariableRepositoryInterface $productVariableRepository,
        AttributeRepositoryInterface $attributeRepository,
        AttributeValueRepositoryInterface $attributeValueRepository,
        AttributeProductVariableRepositoryInterface $attributeProductVariableRepository
    ) {
        $this->productRepository = $productRepository;
        $this->shopRepository = $shopRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productVariableRepository = $productVariableRepository;
        $this->attributeRepository = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
        $this->attributeProductVariableRepository = $attributeProductVariableRepository;
    }

    public function all()
    {
        $categories = $this->categoryRepository->all();
        $shops = $this->shopRepository->all();

        return compact('categories', 'shops');
    }

    public function create(array $attributes)
    {
        // Slug
        $slug = Str::slug($attributes['product_title']);
        $checkSlug = $this->productRepository->findSlug($slug);
        if ($checkSlug) {
            $slug = $this->makeUniqueSlug($slug);
        } 

        // Upload thumbnail to Cloudinary
        $thumbnail_url = Cloudinary::upload($attributes['product_thumbnail']->getRealPath())->getSecurePath();

        // Create Product
        $productData = [
            'slug' => $slug,
            'code_product' => $slug,
            'title' => $attributes['product_title'],
            'thumnail' => $thumbnail_url,
            'shop_id' => $attributes['product_shop'],
            'category_id' => $attributes['product_category'],
        ];
        $product = $this->productRepository->create($productData);
        $productID = $product->id;

        // Check if has Variations
        $variations = [];
        $prefix = 'product_variation_';
        foreach ($attributes as $key => $value) {
            if (strpos($key, $prefix) === 0) {
                $variations[$key] = json_decode($value, true);
            }
        }

        // If has no Variations
        if (!$variations) {

            // Product Code
            $productVariableCode = $slug . '-V-' . rand(0, 5);
            $checkProductVariableCode =  $this->productVariableRepository->findProductCode($productVariableCode);
            while ($checkProductVariableCode) {
                $productVariableCode = $slug . '-V-' . rand(0, 5);
            }

            // Create Product Variable
            $productVariation = [
                'product_code' => $productVariableCode,
                'product_id' => $productID,
                'regular_price' => $attributes['product_price'],
            ];
            $productVariable = $this->productVariableRepository->create($productVariation);

            // Create product's quantity
            $attributeQuantity = $this->attributeRepository->firstOrCreate('quantity');
            $productAttribute = [
                'attribute_id' => $attributeQuantity->id,
                'product_variable_id' => $productVariable->id,
                'value' => $attributes['product_quantity'],
            ];
            $attributeValueQuantity = $this->attributeValueRepository->create($productAttribute);
            $attributeProductVariable = [
                'attribute_value_id' => $attributeValueQuantity->id,
                'product_variable_id' => $productVariable->id,
            ];

            return $this->attributeProductVariableRepository->create($attributeProductVariable);
        } else{

            foreach($variations as $key => $value){
                $attributeProductVariable = [];

                // Product Code
                $code = str_replace("product_variation_", "", $key);
                $productVariableCode = $slug . '-V-' . $code . rand(0, 5);
                $checkProductVariableCode =  $this->productVariableRepository->findProductCode($productVariableCode);
                while ($checkProductVariableCode) {
                    $productVariableCode = $slug . '-V-' . rand(0, 5);
                }

                // Create Product Variable
                $productVariation = [
                    'product_code' => $productVariableCode,
                    'product_id' => $productID,
                    'regular_price' => $value['price'],
                ];
                $productVariable = $this->productVariableRepository->create($productVariation);

               

                // Create attribute value of this product variable
                foreach($value as $key1 => $value1){
                    if(!empty($attributes[$value1])){
                        $value1 = Cloudinary::upload($attributes[$value1]->getRealPath())->getSecurePath();
                    }

                    $attribute = $this->attributeRepository->firstOrCreate($key1);

                    $productAttribute = [
                        'attribute_id' => $attribute->id,
                        'product_variable_id' => $productVariable->id,
                        'value' => $value1,
                    ];
                    $attributeProductVariable = $this->attributeValueRepository->create($productAttribute);

                    $attributeProductVariable = [
                        'attribute_value_id' => $attributeProductVariable->id,
                        'product_variable_id' => $productVariable->id,
                    ];

                    $this->attributeProductVariableRepository->create($attributeProductVariable);
                }
            }
        }
            return true;
    }

    private function makeUniqueSlug($slug, $counter = 1)
    {
        $newSlug = $slug . '-' . $counter;
            $checkSlug = $this->productRepository->findSlug($newSlug);

            if ($checkSlug) {
                return $this->makeUniqueSlug($slug, ++$counter);
            }
        return $newSlug;
    }

    private function makeUniqueProductCode($productCode, $counter = 1, $model)
    {
        $newProductCode = $productCode . '-' . $counter;
        if ($model == 'product') {
            $checkProductCode = $this->productRepository->findProductCode($newProductCode);

            if ($checkProductCode) {
                return $this->makeUniqueProductCode($productCode, ++$counter, $model = 'product');
            }
        } else if ($model == 'productVariable') {
            $checkProductCode = $this->productVariableRepository->findProductCode($newProductCode);

            if ($checkProductCode) {
                return $this->makeUniqueProductCode($productCode, ++$counter, $model = 'productVariable');
            }
        }

        return $newProductCode;
    }
}
