<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInfoRequest extends FormRequest
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
            'name' => [ 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => [ 'unique:users','regex:/(09)[0-9]{9}/'],
        ];
    }
}
