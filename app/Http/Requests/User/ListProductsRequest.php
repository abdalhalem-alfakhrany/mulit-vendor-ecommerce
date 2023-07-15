<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ListProductsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'filter' => 'in:tags,vendor,preferred,search|nullable',
            'product_name' => 'string|nullable',
            'vendor_id' => 'nullable|numeric',
            'tags_ids' => 'array|nullable'
        ];
    }
}
