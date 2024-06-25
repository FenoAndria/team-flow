<?php

namespace App\Http\Resources\Member;

use App\Http\Resources\TeamResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberTeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'team' => new TeamResource($this->team),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
