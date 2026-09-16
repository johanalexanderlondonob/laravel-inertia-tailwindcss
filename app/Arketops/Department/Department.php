<?php

namespace App\Arketops\Department;

use App\Arketops\Base\BaseModel;
use App\Arketops\City\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'id_department';

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
