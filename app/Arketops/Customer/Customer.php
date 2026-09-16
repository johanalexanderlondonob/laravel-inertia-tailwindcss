<?php

namespace App\Arketops\Customer;

use App\Arketops\Base\BaseModel;
use App\Arketops\Third\Third;
use App\Arketops\Worksheet\Worksheet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'id_third';

    protected $with = ['third'];

    public function third(): BelongsTo
    {
        return $this->belongsTo(Third::class, 'id_third');
    }

    public function worksheets(): HasMany
    {
        return $this->hasMany(Worksheet::class, 'id_customer');
    }
}
