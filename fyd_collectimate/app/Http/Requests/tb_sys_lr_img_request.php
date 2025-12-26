<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class tb_sys_lr_img_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'filename'     => 'nullable|max:255',
            'table_name'   => 'required|max:255',
            'path'         => 'required|max:1000',
        ];
    }
}
