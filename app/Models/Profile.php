<?php

namespace App\Models;

use App\Models\Filemaker\FMMemberEdit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    use HasFactory;

    public static $fm_fields = [
        'id',
        'person_id',
        'paid_year',
        'name',
        'email',
        'phone',
        'address',
        'zip',
        'city',
        'yearly_fee',
        'supporting',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'female',
        'bsk',
    ];

    protected $fillable = [
        'id',
        'person_id',
        'paid_year',
        'name',
        'email',
        'phone',
        'address',
        'zip',
        'city',
        'yearly_fee',
        'supporting',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'female',
        'bsk',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',

    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }



}
