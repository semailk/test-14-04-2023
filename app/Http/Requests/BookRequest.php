<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests\Story
 *
 * @OA\RequestBody (
 *     request="StoryRequest",
 *     required=true,
 *     @OA\JsonContent (
 *         @OA\Property (
 *             property="genre_id",
 *             type="integer"
 *         ),
 *         @OA\Property (
 *             property="title",
 *             type="string"
 *         ),
 *         @OA\Property (
 *             property="authors_ids",
 *             type="object"
 *         ),
 *         @OA\Property (
 *             property="description",
 *             type="string"
 *         ),
 *         @OA\Property (
 *             property="age",
 *             type="integer"
 *         ),
 *     )
 * )
 */
class BookRequest extends FormRequest
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
        $requirement = $this->isMethod('PATH') ? 'sometimes' : 'required';

        return [
            'genre_id' => [
                'exists:genres,id',
                'integer',
                $requirement
            ],
            'title' => [
                'string',
                $requirement,
                'min:1',
                'max:255'
            ],
            'authors_ids' => [
                'array',
                $requirement
            ],
            'authors_ids.*' => [
                'exists:authors,id',
            ],
            'description' => [
                $requirement,
                'string',
                'min:1',
                'max:65000'
            ],
            'age' => [
                $requirement,
                'integer'
            ]
        ];
    }
}
