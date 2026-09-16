<?php

namespace App\Arketops\ProcessLeader;

use App\Arketops\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProcessLeader extends BaseModel
{
    use HasFactory;

    protected $table = 'processes_leaders';
}
