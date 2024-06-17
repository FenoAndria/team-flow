<?php

namespace App\Http\Resources;

use App\Http\Resources\Member\MemberResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'lead' => $this->lead && $this->lead->profil ? [
                'name' => $this->lead->profil->name,
                'email' => $this->lead->email,
            ] : null,
            'task' => TaskResource::collection($this->task),
            'member' => MemberResource::collection($this->member),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
