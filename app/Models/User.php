<?php

namespace App\Models;

use App\Arketops\Consideration\Consideration;
use App\Arketops\Third\Third;
use App\Arketops\WorksheetDetail\WorksheetDetail;
use App\Arketops\WorksheetProcess\WorksheetProcess;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use MustVerifyEmail;

    public function third()
    {
        return $this->belongsTo(Third::class);
    }

    public function worksheetsDetails()
    {
        return $this->belongsTo(WorksheetDetail::class);
    }

    public function considerations()
    {
        return $this->hasMany(Consideration::class);
    }

    public function worksheetProcesses(): HasMany
    {
        return $this->hasMany(WorksheetProcess::class, 'id');
    }

    public function worksheetDetails(): HasMany
    {
        return $this->hasMany(WorksheetDetail::class, 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
