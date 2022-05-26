<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user()->id)],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'slug' => ['required', Rule::unique('users')->ignore(auth()->user()->id)],
            'pic' => ['nullable', 'mimes:jpg,jpeg,png,webp,avif', 'max:100'],
            'bio' => ['nullable', 'max:140']
        ];
    }
}
