<?php

namespace App\Models\Fortnox;

use App\Models\Fortnox\IsFortnoxEntity;
use Illuminate\Database\Eloquent\Model;

class FortnoxFinancialYear extends Model
{
    use IsFortnoxEntity;

    protected $fortnox_key_field='id';
    protected $guarded=[];
    protected $primaryKey = 'fortnox_id';
}
