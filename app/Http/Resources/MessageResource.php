<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'team' => [
                'name' => $this->team->name,
                'lead' => [
                    'id' => $this->team->lead->id,
                    'name' => $this->team->lead->profil->name,
                ]
            ],
            'sender' => [
                'id' => $this->sender->id,
                'name' => $this->sender->profil->name
            ],
            'content' => $this->content,
            'created_at' => $this->created_at,
        ];
    }
}
