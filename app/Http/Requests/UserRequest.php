<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "name" => "required|string|min:1|max:255",
            "email" =>
                "required|email|min:1|max:255|unique:users,email," . $this->id,
            "phone" =>
                "required|numeric|digits:10|unique:users,id," . $this->id,
            "password" =>
                "required_without:_method|nullable|string|max:255|confirmed",
            "nationality" => "required|string",
            "job" => "required|string",
            "company_name" => "required|string",
            "is_admin" => "required|integer|in:0,1",
            "image" => "required_without:_method|nullable|image",
            "permissions*" => "required",
        ];
    }
}
