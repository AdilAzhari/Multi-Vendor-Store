<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255|required|max:255',
            'description' => 'nullable|string|max:255',
            'image' => 'string|nullable',
            'price' => 'sometimes|numeric|min:0|required',
            'status' => 'in:published,draft,archived',
            'category_id' => 'sometimes|required|exists:categories,id',
            'compare_price' => 'numeric|min:0|nullable|gt:price',
        ];
    }
}
