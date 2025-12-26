<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class tb_sys_mf_user_site_request extends FormRequest
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
            'user_id'            => 'required',
            'site_id'            => 'required|unique:tb_sys_mf_user_site,site_id,'.$this->id.',id,user_id,' . $this->user_id,
            'remarks'            => 'nullable|max:1000',
        ];
    }
}
