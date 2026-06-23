<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'author_name' => 'required|string|max:255',
            'body' => 'required|string',
        ];
    }
}
