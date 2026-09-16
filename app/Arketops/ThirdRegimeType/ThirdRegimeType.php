<?php

namespace App\Arketops\ThirdRegimeType;

use App\Arketops\Base\BaseModel;
use App\Arketops\Third\Third;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThirdRegimeType extends BaseModel
{
    use HasFactory;

//    protected $table = 'third_regime_types';
    protected $primaryKey = 'id_regime_type';

    public function thirds()
    {
        return $this->hasMany(Third::class);
    }
}
