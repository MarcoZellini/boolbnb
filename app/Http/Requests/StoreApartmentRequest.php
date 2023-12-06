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
            'title' => ['required', 'string', 'min:3', 'max:100', Rule::unique('apartments')],
            'description' => ['nullable', 'string', 'max:300'],
            'rooms' => ['nullable', 'integer', 'min:1', 'max:10'],
            'beds' => ['nullable', 'integer', 'min:1', 'max:10'],
            'bathrooms' => ['nullable', 'integer', 'min:1', 'max:10'],
            'square_meters' => ['nullable', 'integer', 'max:1000'],
            'address' => ['nullable', 'string', 'max: 255'],
            'is_visible' => ['nullable', 'boolean']
        ];
    }
}
