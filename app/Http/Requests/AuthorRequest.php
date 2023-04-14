<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        $requirement = $this->isMethod('PATCH') ? 'sometimes' : 'required';

        return [
            'first_name' => [
                $requirement,
                'string',
                'min:1',
                'max:255'
            ],
            'last_name' => [
                $requirement,
                'string',
                'min:1',
                'max:255'
            ],
            'surname' => [
                $requirement,
                'string',
                'min:1',
                'max:255'
            ]
        ];
    }
}
