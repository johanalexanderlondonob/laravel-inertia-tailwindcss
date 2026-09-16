<?php

namespace App\Arketops\City;

use App\Arketops\Base\BaseModel;
use App\Arketops\Third\Third;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends BaseModel
{
    use HasFactory;

    protected $table = 'cities';
    protected $primaryKey = 'id_city';

    public function thirds()
    {
        return $this->hasMany(Third::class);
    }
}
