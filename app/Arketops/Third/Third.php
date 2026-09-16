<?php

namespace App\Arketops\Third;

use App\Arketops\Base\BaseModel;
use App\Arketops\City\City;
use App\Arketops\Customer\Customer;
use App\Arketops\IdentificationType\IdentificationType;
use App\Arketops\NatureType\NatureType;
use App\Arketops\ThirdRegimeType\ThirdRegimeType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Third extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'id_third';

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function natureType()
    {
        return $this->belongsTo(NatureType::class);
    }

    public function identificationType()
    {
        return $this->belongsTo(IdentificationType::class);
    }

    public function regimeType()
    {
        return $this->belongsTo(ThirdRegimeType::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id_third');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    protected $fillable = ['id_city', 'id_nature_type', 'id_identification_type', 'id_regime_type', 'nit', 'third_name', 'name1', 'name2', 'lastname1', 'lastname2', 'phone1', 'phone2', 'address', 'email'];
}
