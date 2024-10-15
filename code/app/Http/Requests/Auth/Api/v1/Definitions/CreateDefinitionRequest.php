<?php
namespace App\Http\Requests\Auth\Api\v1\Definitions;

use Illuminate\Foundation\Http\FormRequest;

class CreateDefinitionRequest extends FormRequest
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
            'wordId' => 'required|integer|max:15',
            'wordTypeId' => 'required|integer|max:15',
            'definition' => 'required|string',
        ];
    }
}
