<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name'=>'required|min:3|max:255|string',
            'email'=>'required|email|max:255|min:3|unique:users,email',
            'mobile'=>'required|digits:11|unique:users,mobile',
            'role'=>'required|in:admin,user,seller'

        ];
    }
}
