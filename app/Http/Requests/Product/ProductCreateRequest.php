<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'slug' => 'required|min:3|max:255|unique:products',
            'sku' => 'required|min:3|max:255|unique:products',
            'affiliate_link' => 'nullable',
            'featured_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'gallery_image.*' => 'sometimes|image|mimes:jpg,jpeg,png,gif,svg|dimensions:min_width=100,min_height=100',
            'short_description' => 'required',
            'description' => 'required',
            'productType' => 'required',
            'tags' => 'nullable',
            'specifications' => 'nullable',
            'specification_name' => 'nullable',
            'specification_description' => 'nullable',
            'stock' => 'nullable|numeric',
            'type_id'   => 'required',
            'category_id'   => 'required|numeric',
            'subcategory_id'   => 'nullable|numeric',
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric',
            'video_link' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_descriptions' => 'nullable',
            'customize_charge' => 'nullable',
        ];
    }
}
