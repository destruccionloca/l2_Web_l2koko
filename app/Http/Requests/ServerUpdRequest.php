<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServerUpdRequest extends FormRequest
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
        $server = $this->route('server');

        return [
            'name' => 'required|max:190',
            'chronicle_id' => 'required',
            'rate_id' => 'required',
            'start_at' => 'required|date',
            'link' => 'required|url|max:190',
            'email' => 'required|email|max:190|unique:servers,email,' . $server->id,
            'vk' => 'url|max:190',
            'fb' => 'url|max:190',
            'tw' => 'url|max:190',
            'picture' => 'file|image'
        ];
    }
}
