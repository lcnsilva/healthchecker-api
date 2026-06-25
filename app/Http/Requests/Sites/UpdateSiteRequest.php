<?php

namespace App\Http\Requests\Sites;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'name' => ['required', 'string', 'max:120'],
            'url' => ['required', 'url', 'max:2048', 'starts_with:http://,https://'],
            'is_paused' => ['sometimes', 'boolean']
        ];
    }
}