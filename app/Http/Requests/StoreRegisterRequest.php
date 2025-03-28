<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterRequest extends FormRequest
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
      'username' => 'required|string|max:30',
      'age' => 'required|max:2|regex:/\d/',
      'phone' => 'required|max:13|regex:/\d/|unique:users,phone',
      'email' => 'required|max:40|email|unique:users,email',
      'password' => 'required|confirmed|max:16|min:6',
      'image' => 'nullable|file|image|mimes:png,jpg,jpeg|max:2048'
    ];
  }
}
