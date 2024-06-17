<?php

namespace App\Rules;

use App\Models\Team;
use App\Traits\TeamTrait;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckIfTeamHaveLead implements ValidationRule
{
    use TeamTrait;
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Team::find($value)->lead_id) {
            $fail('Team selected have already a lead!');
        }
    }
}
