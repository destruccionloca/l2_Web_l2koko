<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
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
            'title' => 'required|max:190',
            'link' => 'required|max:190|url',
            'alt' => 'required|max:190',
            'token' => 'required|max:190',
            'group_id' => 'required|max:190',
            'picture' => 'file|image'
        ];
    }
}
