<?php

namespace App\Models\Filemaker;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GearboxSolutions\EloquentFileMaker\Database\Eloquent\FMModel;

class FMMemberList extends FMModel
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;

    protected $connection = 'filemaker';
    protected $layout = "Member | List";

    protected $fieldMapping = [
        'Member Card Number' => 'member_no',
        'Social Number' => 'person_id',
        'Member | Member Object | Contract::Year' => 'paid_year',
    ];


}
