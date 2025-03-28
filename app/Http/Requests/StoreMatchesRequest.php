<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatchesRequest extends FormRequest
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

            'match_url'=>'required',
            'stadium'=>'required',
            'team_1'=>'required',
            'team_1_logo'=>'required',
            'team_2_logo'=>'required',
            'team_2'=>'required',
            'champion'=>'required',
            'result'=>'required',

        ];
    }
}
