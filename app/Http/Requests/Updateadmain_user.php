<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Updateadmain_user extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'string|max:30',
            'age' => 'max:2|regex:/\d/',
            'phone' => 'max:13|regex:/\d/|unique:users,phone',
            'email' => 'max:40|email|unique:users,email',
            'password' => 'max:16|min:6',
            'image' => 'nullable|file|image|mimes:png,jpg,jpeg|max:2048',
            'block'=>'boolean',
            'role'=>'string|max:40'
        ];
    }
}

