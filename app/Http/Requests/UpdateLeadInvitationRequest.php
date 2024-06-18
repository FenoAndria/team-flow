<?php

namespace App\Http\Requests;

use App\Rules\CheckIfUserIsInvited;
use App\Rules\CheckIfUserIsLead;
use App\Rules\CheckIfUserIsMember;

class UpdateLeadInvitationRequest extends LayoutRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', 'in:Accepted,Declined'],
        ];
    }
}
