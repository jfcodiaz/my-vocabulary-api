<?php
namespace App\Http\Requests\Auth\Api\v1\Word;

use Illuminate\Foundation\Http\FormRequest;

class CreateWordRequest extends FormRequest
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
        return [
            'word' => 'required|string|max:255|regex:/^[a-zA-Z]+$/',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'word.required' => 'A word is required to create a new entry.',
            'word.string'   => 'The word must be a string.',
            'word.max'      => 'The word must not be longer than 255 characters.',
            'word.regex'    => 'The word must only contain letters.',
        ];
    }
}
