<?php

namespace App\Http\Requests\App;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */


    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'userphone' => 'required|',
            'password' => 'required|alpha_dash|min:6|max:20',
        ];
    }
}
