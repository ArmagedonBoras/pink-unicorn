<?php

namespace App\Models\Fortnox;

use App\Models\Fortnox\IsFortnoxEntity;
use Illuminate\Database\Eloquent\Model;

class FortnoxArticle extends Model
{
    use IsFortnoxEntity;

    protected $fortnox_key_field='article_number';
    protected $completeFortnoxItems = true;
    protected $guarded=[];
}
