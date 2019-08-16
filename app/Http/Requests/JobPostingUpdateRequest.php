<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPostingUpdateRequest extends FormRequest
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
            'cover_image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'alt_tag' => 'required|alpha_dash|min:3|max:255',
            'title' => 'required|regex:/^[a-zA-Z0-9\s]+$/|min:2|max:200',
            'job_title' => 'required|regex:/^[a-zA-Z0-9\s]+$/|min:2|max:200',
            'job_description' => 'required|min:5',
            'beginning_date' => 'required',
            'ending_date' => 'required'
        ];
    }
}
