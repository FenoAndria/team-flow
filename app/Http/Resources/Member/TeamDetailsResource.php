<?php

namespace App\Http\Resources\Member;

use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lead' => [
                'name' => (new UserResource($this->lead))->profil->name,
                'email' => (new UserResource($this->lead))->email,
            ],
            'task' => TaskResource::collection($this->task),
            'member' => MemberResource::collection($this->member),
        ];
    }
}
