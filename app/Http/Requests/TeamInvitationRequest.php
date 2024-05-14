<?php

namespace App\Http\Requests;

use App\Rules\CheckIfUserIsInvited;
use App\Rules\CheckIfUserIsLead;
use App\Rules\CheckIfUserIsMember;
use App\Rules\UniqueTeamInvitationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamInvitationRequest extends LayoutRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'team_id' => 'exists:teams,id',
            'user_id' => ['required', 'exists:users,id', new CheckIfUserIsMember(), new CheckIfUserIsInvited(), new CheckIfUserIsLead()],
            'status' => 'in:Pending,Accepted,Declined',
        ];
    }
}
