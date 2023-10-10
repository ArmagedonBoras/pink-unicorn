<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OauthProvider extends Model
{
    // provider => icon
    public static $providers = [
        // 'apple' => 'apple',
        // 'facebook' => 'facebook',
        'github' => 'github',
        // 'google' => 'google',
        // 'instagram' => 'instagram',
        //  'microsoft' => 'microsoft',
        //  'reddit' => 'reddit',
        // 'twitter' => 'twitter-x',
        'discord' => 'discord',
    ];

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function icon()
    {
        return self::$providers[$this->provider];
    }
}
