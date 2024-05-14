<?php

namespace App\Http\Requests;

use App\Traits\TeamTrait;

class AssignUserToSubtaskRequest extends LayoutRequest
{
    use TeamTrait;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id', function ($attribute, $value, $fail) {
                if (!$this->isMember($this->getTeam()->id, $value)) {
                    $fail('User selected is not a member of the team!');
                }
            }],
        ];
    }
}
