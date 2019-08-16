<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'first_name' => 'required|alpha|min:2|max:200',
            'last_name' => 'required|alpha|min:2|max:200',
            'password' => 'required|min:8|max:50',
            'job_title' => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:200',
            'username' => 'unique:users|alpha_num|required|min:2|max:200',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'is_admin' => 'required|bool'
        ];
    }
}
