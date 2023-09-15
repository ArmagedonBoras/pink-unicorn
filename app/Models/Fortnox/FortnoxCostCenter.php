<?php

namespace App\Models\Fortnox;

use App\Models\Fortnox\IsFortnoxEntity;
use Illuminate\Database\Eloquent\Model;

class FortnoxCostCenter extends Model
{
    use IsFortnoxEntity;

    protected $fortnox_key_field='code';
    protected $fortnox_fields = [
        'code',
        'description',
        'active',
    ];
    protected $guarded=[];
}
