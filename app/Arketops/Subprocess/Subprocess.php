<?php

namespace App\Arketops\Subprocess;

use App\Arketops\Base\BaseModel;
use App\Arketops\Process\Process;
use App\Arketops\WorksheetDetail\WorksheetDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subprocess extends BaseModel
{
    use HasFactory;

    protected $table = 'subprocesses';
    protected $primaryKey = 'id_subprocess';

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function worksheetsDetails(): HasMany
    {
        return $this->hasMany(WorksheetDetail::class, 'id_subprocess');
    }
}
