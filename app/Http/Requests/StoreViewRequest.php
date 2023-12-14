<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class StoreViewRequest extends FormRequest
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
            'apartment_id' => [Rule::exists('apartments', 'id')],
            'ip' => ['ip'],
            'date' => [
                'date', Rule::unique('views')->where(function ($query) {
                    $query->where('ip', $this->ip)
                        ->where('date', '>', Carbon::now()->subDay()->format('Y-m-d H:i:s'));
                }),
            ],
        ];
    }
}
