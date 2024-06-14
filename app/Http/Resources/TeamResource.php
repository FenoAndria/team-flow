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
            'lead' => [
                'name' => ($this->lead)->profil->name,
                'email' => ($this->lead)->email,
            ],
            'task' => TaskResource::collection($this->task),
            'member' => MemberResource::collection($this->member),
        ];
    }
}
