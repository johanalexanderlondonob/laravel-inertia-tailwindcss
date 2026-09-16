<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id_process,
            'name' => $this->name,
            'description' => $this->description,
            'sequence' => $this->sequence,
            'active' => $this->active,
            'createdAt' => $this->created_at,
        ];
    }
}
