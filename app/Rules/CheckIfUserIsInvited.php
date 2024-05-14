<?php

namespace App\Rules;

use App\Traits\TeamTrait;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckIfUserIsInvited implements ValidationRule
{
    use TeamTrait;
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->isInvited($this->getTeam()->id, $value)) {
            $fail('User already invited!');
        }
    }
}
