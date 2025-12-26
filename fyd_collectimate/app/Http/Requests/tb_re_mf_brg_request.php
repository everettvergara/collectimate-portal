<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class tb_re_mf_brg_request extends FormRequest
{
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
            'city_id'                   => 'required',
            'code'                      => ['required', 'max:30', 'unique:tb_re_mf_brg,code,' . $this->id . ',id,city_id,' . $this->city_id],
            'name'                      => 'required|max:255',
            'remarks'                   => 'nullable|max:1000',
            'is_active'                 => 'nullable',
        ];
    }
}
