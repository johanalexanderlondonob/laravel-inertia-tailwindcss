<?php

namespace App\Arketops\WorksheetProcess;

use App\Arketops\Base\BaseModel;
use App\Arketops\Process\Process;
use App\Arketops\Worksheet\Worksheet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorksheetProcess extends BaseModel
{
    use HasFactory;

    protected $table = 'worksheets_processes';
    protected $primaryKey = 'id_worksheet_process';
    protected $fillable = ['id_worksheet', 'id_process', 'ideal_completion_date', 'creator_user'];

    public function worksheet(): BelongsTo
    {
        return $this->belongsTo(Worksheet::class, 'id_worksheet');
    }

    public function process(): BelongsTo
    {
        return $this->belongsTo(Process::class, 'id_process');
    }

    // Removed worksheetDetails(): it related on a non-existent `id_worksheet_process`
    // column on `worksheets_details` (that table only has id_worksheet/id_subprocess/
    // id_user/id_status — see the migration for worksheets_details). Because it was
    // eager-loaded via $with above, ANY query on WorksheetProcess raised a SQL error
    // ("Unknown column worksheets_details.id_worksheet_process"), which meant
    // Worksheet::show() could never actually render. Detail rows are now generated
    // directly against the worksheet in WorksheetProcessRepository::create(), which is
    // what the original MySQL trigger `trigger_generate_worksheet_detail` did.

    public function creatorUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_user');
    }
}
