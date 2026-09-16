<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ThirdResource extends JsonResource
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
            'id'=> $this->id_third,
            'city'=> $this->id_city,
            'natureType'=> $this->id_nature_type,
            'identificationType'=> $this->id_identification_type,
            'regimeType'=> $this->id_regime_type,
            'nit'=> $this->nit,
            'thirdName'=> $this->third_name,
            'name1'=> $this->name1,
            'name2'=> $this->name2,
            'lastname1'=> $this->lastname1,
            'lastname2'=> $this->lastname2,
            'address'=> $this->address,
            'phone1'=> $this->phone1,
            'phone2'=> $this->phone2,
            'email'=> $this->email,
            'createdAt'=> $this->created_at,
            'updatedAt'=> $this->updated_at
        ];
    }
}
