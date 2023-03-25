<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductFormRequest;
use App\Services\Admin\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('admin.product.products');
    }

    public function create()
    {
        $data = $this->productService->all();

        $shops = $data['shops'];
        $categories = $data['categories'];

        return view('admin.product.createProduct', compact('shops', 'categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $result = $this->productService->create($request->all());

        if($result){
            return response()->json(['success_message' => 'Product have created successfully!']);
        }
    }
}
