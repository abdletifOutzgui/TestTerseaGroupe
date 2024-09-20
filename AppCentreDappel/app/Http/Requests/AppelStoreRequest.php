<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppelStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => 'nullable|exists:users,id',
            'comment'   => 'nullable|string',
            'call_time' => 'required|date',
            'duration'  => 'required|integer|min:1',
            'subject'   => 'required|string|max:255',
        ];
    }
}
