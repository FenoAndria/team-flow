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
            // ...parent::toArray($request), 
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'deadline' => $this->deadline,
            'team' => $this->when($request->routeIs('task-index'), $this->team->name),
            'subtasks' => $this->when(!$this->assertRole('Admin'), SubtaskResource::collection($this->subtask)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
