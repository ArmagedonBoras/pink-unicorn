<?php

namespace App\Models;

use App\Traits\Commentable;
use App\Traits\HasGate;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    use Commentable;
    use Taggable;
    use HasGate;
}
