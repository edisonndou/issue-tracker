<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    //----------
    public function authorize(): bool
    {
        return true;
    }
    //----------
    /**
     * Validation rules
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:tags,name|max:255',
            'color' => 'nullable|string|max:7',
        ];
    }
}
