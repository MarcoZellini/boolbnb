<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreApartmentRequest extends FormRequest
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
            'user_id' => [Rule::exists('users', 'id')],
            'title' => ['bail', 'required', 'string', 'min:3', 'max:100', Rule::unique('apartments')],
            'description' => ['bail', 'nullable', 'string', 'max:300'],
            'rooms' => ['bail', 'nullable', 'integer', 'min:1', 'max:10'],
            'beds' => ['bail', 'nullable', 'integer', 'min:1', 'max:10'],
            'bathrooms' => ['bail', 'nullable', 'integer', 'min:1', 'max:10'],
            'square_meters' => ['bail', 'nullable', 'integer', 'max:1000'],
            'address' => ['bail', 'nullable', 'string', 'max: 255'],
            'is_visible' => ['bail', 'nullable', 'boolean'],
            'services' => ['required', 'array', 'min:1'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,jpg,png', 'max:1024'],
        ];
    }
}
