<?php

namespace App\Http\Requests\Links;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'link' => ['required', 'string', 'max:255'],
        ];
    }
}
