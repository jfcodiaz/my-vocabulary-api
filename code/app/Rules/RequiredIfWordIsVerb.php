<?php
namespace App\Rules;

use Closure;
use App\Service\v1\Word\IsVerbService;
use App\Contracts\Repositories\IWordTypeRepository;
use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Contracts\Validation\{ DataAwareRule, ValidationRule };

class RequiredIfWordIsVerb implements ValidationRule, DataAwareRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    public $implicit = true;
    /**
     * Run the validation rule.
     *
     * @param  Closure(string): PotentiallyTranslatedString $fail
     */
    public function __construct(
        private IWordTypeRepository $wordTypesRepository,
        private IsVerbService $isVerb
    ){
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $wordType = $this->wordTypesRepository->findById($this->data['wordTypeId']);

        if(!$wordType->conjugation && $value != null){
            $fail("The $attribute field should be null if the wordType is not a conjugation.");
            return;
        }

        if(!$wordType->conjugation) {
            return;
        }

        if($value == null){
            $fail("The $attribute field is required if thew wordType is a conjugation.");
            return;
        }

        if (!($this->isVerb)($this->data[$attribute])) {
            $fail("The verbBaseId field should be a a verb.");
        }
    }

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
