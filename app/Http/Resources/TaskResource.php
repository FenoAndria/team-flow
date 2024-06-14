<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\UserTrait;

class TaskResource extends JsonResource
{
    use UserTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'team' => $this->when($request->routeIs('task-index'), $this->team->name),
            'subtasks' => $this->when(!$this->assertRole('Admin'), SubtaskResource::collection($this->subtask))
        ];
    }
}
