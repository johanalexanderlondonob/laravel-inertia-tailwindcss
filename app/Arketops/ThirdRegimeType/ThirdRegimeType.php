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
    // The `third_regime_types` table has no created_at/updated_at columns.
    public $timestamps = false;

    public function thirds()
    {
        return $this->hasMany(Third::class);
    }
}
