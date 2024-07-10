<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Member\MemberTeamResource;
use App\Traits\TeamTrait;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberForAdminresource extends JsonResource
{
    use TeamTrait, UserTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'profil' => [
                'name' => $this->profil->name
            ],
            'team_lead' => $this->when($this->isLead($this->id), ($this->isLead($this->id))),
            'team_member' => $this->when(!$this->isLead($this->id), MemberTeamResource::collection($this->getUserTeams($this->id))),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
