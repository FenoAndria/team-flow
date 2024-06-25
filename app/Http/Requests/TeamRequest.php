<?php

namespace App\Http\Requests;

use App\Models\TeamMember;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamRequest extends LayoutRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            // 'lead_id' => ['nullable', 'exists:users,id', Rule::unique('teams')->ignore($this->route('team')), function ($attribute, $value, $fail) {
            //     if (TeamMember::where('user_id', $value)->exists()) {
            //         $fail('User selected already member of a team!');
            //     }
            // }]
        ];
    }
}
