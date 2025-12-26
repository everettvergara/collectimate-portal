<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class tb_sys_lr_img_style_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check()){
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
            'img_id'         => 'required|integer',
            'style_id'       => 'required|integer|unique:tb_sys_lr_img_style,style_id,'.$this->id.',id,img_id,' . $this->img_id,
        ];
    }
}
