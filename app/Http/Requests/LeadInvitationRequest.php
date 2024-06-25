<?php

namespace App\Http\Requests;

use App\Models\LeadInvitation;
use App\Rules\CheckIfTeamHaveLead;
use App\Rules\CheckIfUserIsLead;

class LeadInvitationRequest extends LayoutRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'team_id' => ['required', 'exists:teams,id', new CheckIfTeamHaveLead()],
            'user_id' => ['required', 'exists:users,id',  new CheckIfUserIsLead(), function ($attribute, $value, $fail) {
                if (LeadInvitation::where(['team_id' => $this->team_id, 'user_id' => $value])->exists()) {
                    $fail('User selected already invited for the team selected!');
                }
            }],
        ];
    }
}
