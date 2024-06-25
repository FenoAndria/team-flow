<?php

namespace App\Http\Requests;

use App\Models\Team;

class TaskRequest extends LayoutRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'nullable|date',
            'team_id' => ['required', 'exists:teams,id', function ($attribute, $value, $fail) {
                if (!(Team::find($value)?->lead_id)) {
                    $fail('Task must be assigned to the team that has a lead!');
                }
            }],
        ];
    }
}
