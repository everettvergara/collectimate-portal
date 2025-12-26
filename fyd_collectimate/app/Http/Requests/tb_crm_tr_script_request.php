<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class tb_crm_tr_script_request extends FormRequest
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
            'code'                  => 'required|max:30',
            'name'                  => 'required|max:255',
            'client_id'             => 'required',
            'license_type_id'       => 'required',
            'description'           => 'nullable|max:1000',
            'json_file_path'        => 'nullable|max:1000',
        ];
    }
}
