<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        switch ($this->method()) {
            case 'PATCH':
            case 'PUT':
                $rules = [
                    'name' => 'required|string|max:200|min:3',
                    'permissions' => 'required|array',
                ];
                break;

            default:
                $rules = [
                    'name' => 'required|string|max:200|min:3',
                    'permissions' => 'required|array',
                ];
                break;
        }
        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'permissions.required' => 'Please select at least one permission.',
        ];
    }
}
