<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateproductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image',
            'price' => 'required|numeric',
            'compare_price' => 'numeric',
            'options' => 'string|nullable',
            'rating' => 'numeric',
            'featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',
        ];
    }
}
