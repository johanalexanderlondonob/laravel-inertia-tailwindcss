<?php

namespace App\Arketops\Department;

use App\Arketops\Base\BaseModel;
use App\Arketops\City\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'id_department';
    // The `departments` table has no created_at/updated_at columns.
    public $timestamps = false;

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
