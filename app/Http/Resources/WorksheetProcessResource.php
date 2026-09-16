<?php

namespace App\Http\Resources;

use App\Arketops\WorksheetDetail\WorksheetDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class WorksheetProcessResource extends JsonResource
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
            'id' => $this->id_worksheet_process,
            'idealCompletionDate' => $this->ideal_completion_date,
            'worksheet' => $this->id_worksheet,
            'creator' => UserResource::make($this->creatorUser),
            'process' => ProcessResource::make($this->process),
            'details' => WorksheetDetailResource::collection($this->worksheetDetails),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
