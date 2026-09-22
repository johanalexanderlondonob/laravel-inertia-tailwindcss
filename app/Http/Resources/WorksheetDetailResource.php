<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorksheetDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id_worksheet_detail,
            'worksheet' => $this->id_worksheet,
            'subprocess' => SubprocessResource::make($this->subprocess),
            'user' => UserResource::make($this->user),
            'status' => StatusResource::make($this->status),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
