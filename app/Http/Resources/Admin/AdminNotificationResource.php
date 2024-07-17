<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminNotificationResource extends JsonResource
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
            'team' => $this->team,
            'user' => $this->user?->profil,
            'type' => $this->type,
            'data' => $this->data,
            'read' => $this->read,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
