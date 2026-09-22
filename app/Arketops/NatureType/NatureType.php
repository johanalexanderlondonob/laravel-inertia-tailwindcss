<?php

namespace App\Arketops\NatureType;

use App\Arketops\Base\BaseModel;
use App\Arketops\Third\Third;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NatureType extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'id_nature_type';
    // The `nature_types` table has no created_at/updated_at columns.
    public $timestamps = false;

    public function thirds()
    {
        return $this->hasMany(Third::class);
    }
}
