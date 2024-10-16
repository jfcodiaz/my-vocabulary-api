<?php
namespace App\Http\Requests\Auth\Api\v1\Definitions;

use App\Rules\RequiredIfWordIsVerb;
use App\Service\v1\Word\IsVerbService;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\IWordTypeRepository;

class CreateDefinitionRequest extends FormRequest
{

    public function __construct(
        private IWordTypeRepository $wordTypeRepository,
        private IsVerbService $isVerb
    ) {
        parent::__construct();
    }

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
            'wordId' => 'required|integer|exists:words,id',
            'wordTypeId' => 'required|integer|exists:word_types,id',
            'definition' => 'required|string',
            'verbBaseId' => [
                'exists:word_types,id',
                 new RequiredIfWordIsVerb(
                    isVerb: $this->isVerb,
                    wordTypesRepository: $this->wordTypeRepository
                )
            ]
        ];
    }
}
