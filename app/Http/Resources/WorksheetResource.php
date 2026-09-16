<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorksheetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id_worksheet,
            'period' => $this->period,
            'customer' => CustomerResource::make($this->customer),
            'opened' => $this->opened,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'worksheetProcesses' => WorksheetProcessResource::collection($this->worksheetProcesses)
        ];
    }
}
