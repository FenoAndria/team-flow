<?php

namespace App\Http\Requests;

class UpdateMemberInvitationRequest extends LayoutRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'in:Pending,Accepted,Declined',
        ];
    }
}
