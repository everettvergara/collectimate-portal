<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class tb_crm_mf_license_request extends FormRequest
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
            'code'                      => ['required', 'max:100', Rule::unique('tb_crm_mf_license', 'code')->ignore(Request()->id)],
            'client_id'                 => 'nullable',
            'device_id'                 => 'nullable',
            'cache_expiration_date'     => 'nullable',
            'cache_license_type_id'     => 'nullable',
            'cache_no_of_license'       => 'nullable',
        ];
    }
}
