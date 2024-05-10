<?php

namespace App\Http\Requests;

class SubtaskRequest extends LayoutRequest
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
            'status' => 'in:Todo,In Progress,Completed,Cancelled',
            'deadline' => 'nullable|date',
            'assigned_to' => 'exists:users,id',
        ];
    }
}
