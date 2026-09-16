<?php

namespace App\Arketops\WorksheetDetail;

use App\Arketops\Base\BaseModel;
use App\Arketops\Status\Status;
use App\Arketops\Subprocess\Subprocess;
use App\Arketops\WorksheetProcess\WorksheetProcess;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorksheetDetail extends BaseModel
{
    use HasFactory;

    protected $table = 'worksheets_details';
    protected $primaryKey = 'id_worksheet_detail';
    protected $fillable = ['id_worksheet', 'id_subprocess', 'id_user', 'id_status'];

    public function worksheetProcess(): BelongsTo
    {
        return $this->belongsTo(WorksheetProcess::class);
    }

    public function subprocess(): BelongsTo
    {
        return $this->belongsTo(Subprocess::class, 'id_subprocess');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
