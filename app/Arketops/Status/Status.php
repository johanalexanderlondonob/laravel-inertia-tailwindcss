<?php

namespace App\Arketops\Status;

use App\Arketops\Base\BaseModel;
use App\Arketops\WorksheetDetail\WorksheetDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends BaseModel
{
    use HasFactory;

    protected $table = 'statuses';
    protected $primaryKey = 'id_status';

    public function worksheetsDetails(): HasMany
    {
        return $this->hasMany(WorksheetDetail::class, 'id_status');
    }
}
