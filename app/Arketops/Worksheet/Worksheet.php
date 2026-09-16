<?php

namespace App\Arketops\Worksheet;

use App\Arketops\Base\BaseModel;
use App\Arketops\Customer\Customer;
use App\Arketops\WorksheetProcess\WorksheetProcess;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Worksheet extends BaseModel
{
    use HasFactory;

    protected $table = 'worksheets';
    protected $primaryKey = 'id_worksheet';
    protected $fillable = ['id_customer', 'period'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function worksheetProcesses(): HasMany
    {
        return $this->hasMany(WorksheetProcess::class, 'id_worksheet');
    }
}
