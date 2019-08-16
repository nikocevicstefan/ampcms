<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'alt_tag' => 'required|alpha_dash|min:2|max:50',
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|min:2|max:255',
            'short_description' => 'required|min:6|max:255',
            'intro_text' => 'required|min:6|max:255',
            'main_text' => 'required|min:12',
            'thumbnail'  => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ];
    }
}
