<?php

namespace App\Http\Resources;

use App\Traits\TeamTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    use TeamTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'profil' => $this->profil,
            'team' => $this->when($this->isLead($this->id), ($this->isLead($this->id))),
        ];
    }
}
