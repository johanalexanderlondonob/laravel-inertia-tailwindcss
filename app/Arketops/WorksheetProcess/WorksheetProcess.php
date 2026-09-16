<?php

namespace App\Arketops\WorksheetProcess;

use App\Arketops\Base\BaseModel;
use App\Arketops\Process\Process;
use App\Arketops\Worksheet\Worksheet;
use App\Arketops\WorksheetDetail\WorksheetDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorksheetProcess extends BaseModel
{
    use HasFactory;

    protected $table = 'worksheets_processes';
    protected $primaryKey = 'id_worksheet_process';
    protected $fillable = ['id_worksheet', 'id_process', 'ideal_completion_date', 'creator_user'];
    protected $with = ['worksheetDetails'];

    public function worksheet(): BelongsTo
    {
        return $this->belongsTo(Worksheet::class, 'id_worksheet');
    }

    public function process(): BelongsTo
    {
        return $this->belongsTo(Process::class, 'id_process');
    }

    public function worksheetDetails(): HasMany
    {
        return $this->hasMany(WorksheetDetail::class, 'id_worksheet_process');
    }

    public function creatorUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_user');
    }
}
