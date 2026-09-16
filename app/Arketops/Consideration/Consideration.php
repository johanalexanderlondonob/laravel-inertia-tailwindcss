<?php

namespace App\Arketops\Consideration;

use App\Arketops\Base\BaseModel;
use App\Arketops\WorksheetDetail\WorksheetDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consideration extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'id_consideration';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function worksheetDetail()
    {
        return $this->belongsTo(WorksheetDetail::class);
    }
}
