<?php

namespace App\Arketops\Process;

use App\Arketops\Base\BaseModel;
use App\Arketops\Subprocess\Subprocess;
use App\Arketops\WorksheetProcess\WorksheetProcess;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Process extends BaseModel
{
    use HasFactory;

    protected $table = 'processes';
    protected $primaryKey = 'id_process';

    public function subprocesses()
    {
        return $this->hasMany(Subprocess::class);
    }

    public function worksheetProcess(): HasMany
    {
        return $this->hasMany(WorksheetProcess::class, 'id_process');
    }
}
