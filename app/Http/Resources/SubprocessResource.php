<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubprocessResource extends JsonResource
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
            'id' => $this->id_subprocess,
            'process' => $this->id_process,
            'name' => $this->name,
            'description' => $this->description,
            'executionOrder' => $this->execution_order,
            'active' => $this->active,
            'createdAt' => $this->created_at,
        ];
    }
}
