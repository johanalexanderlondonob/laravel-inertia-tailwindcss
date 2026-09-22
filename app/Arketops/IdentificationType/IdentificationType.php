<?php

namespace App\Arketops\IdentificationType;

use App\Arketops\Base\BaseModel;
use App\Arketops\Third\Third;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdentificationType extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'id_identification_type';
    // The `identification_types` table has no created_at/updated_at columns.
    public $timestamps = false;

    public function thirds()
    {
        return $this->hasMany(Third::class);
    }
}
