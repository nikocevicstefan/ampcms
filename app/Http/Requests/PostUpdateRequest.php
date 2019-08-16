<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
            'title' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'introductory_content' => 'required',
            'main_content' => 'required',
            'alt_tag' => 'required',
            'tags' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ];
    }
}
