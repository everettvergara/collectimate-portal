<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class tb_sys_mf_mod_request extends FormRequest
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
            'code'                      => 'required|max:30',
            'name'                      => 'required|max:255',
            'mod_group_id'              => 'nullable',
            'seq'                       => 'numeric|nullable',
            'url'                       => 'nullable|max:255',
            'remarks'                   => 'nullable|max:1000',
            'is_active'                 => 'nullable',
            'is_visible'                => 'nullable',
        ];
    }
}
