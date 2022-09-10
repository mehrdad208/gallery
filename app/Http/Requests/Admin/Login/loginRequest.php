<?php

namespace App\Http\Requests\Admin\Login;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
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
            'national_code'=>['required','digits:10','numeric'],
            'password'=>['required','min:8','max:200']
        ];
    }

    public function attributes()
    {
        return[
        'password'=>'رمز عبور',
        ];
    }
}
