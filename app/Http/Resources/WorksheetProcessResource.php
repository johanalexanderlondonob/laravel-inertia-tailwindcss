<?php

namespace App\Http\Resources;

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
            // 'details' used to call a WorksheetProcess::worksheetDetails() relation that
            // joined on a column (`worksheets_details.id_worksheet_process`) that doesn't
            // exist in the schema — see the removed relation in the WorksheetProcess model
            // for details. Worksheet details are keyed by id_worksheet + id_subprocess,
            // not by id_worksheet_process, so they aren't a natural fit for this resource.
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
