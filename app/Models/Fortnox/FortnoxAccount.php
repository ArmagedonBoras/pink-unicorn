<?php

namespace App\Models\Fortnox;

use App\Models\Fortnox\IsFortnoxEntity;
use Illuminate\Database\Eloquent\Model;

class FortnoxAccount extends Model
{
    use IsFortnoxEntity;

    protected $fortnox_key_field='number';
    protected $guarded=[];
}
