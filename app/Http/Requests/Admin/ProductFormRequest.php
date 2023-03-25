<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_title' => 'required|string',
            'product_description' => 'required|string',
            'product_thumbail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'product_gallery_images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'product_gallery_images' => 'array',
            'product_shop' => 'required',
            'product_category' => 'required',
            'product_quantity' => 'required|numeric|min:0',
            'product_price' => 'required|min:0',
        ];
    }
}
