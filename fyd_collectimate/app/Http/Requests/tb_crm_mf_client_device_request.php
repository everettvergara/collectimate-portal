<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class tb_crm_mf_client_device_request extends FormRequest
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
            'client_id'                 => 'required',
            'code'                      => ['required', 'max:30', 'unique:tb_crm_mf_client_device,code,' . $this->id . ',id,client_id,' . $this->client_id],
            'name'                      => 'required|max:255',
            'client_key'                => 'nullable|max:255',
            'remarks'                   => 'nullable|max:1000',
            'is_active'                 => 'nullable',
        ];
    }
}
