<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:200', 'min:5', Rule::unique('projects')->ignore($this->project)],
            'type_id' => ['nullable', 'exists:types,id'],
            'technology' => ['nullable', 'exista,id'],
            'content' => ['nullable', 'min:10', 'max:5000'],
            'star_date' => ['nullable'],
            'end_date' => ['nullable']
        ];
    }
}
