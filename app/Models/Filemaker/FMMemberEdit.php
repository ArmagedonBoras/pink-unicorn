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

class FMMemberEdit extends FMModel
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;

    protected $connection = 'filemaker';
    protected $layout = "Member | Edit";

    protected $fieldMapping = [
        'Member Card Number' => 'member_no',
        'Social Number' => 'person_id',
        'Member | Member Object | Contract::Year' => 'paid_year',
        'Name' => 'name',
        'Email' => 'email',
        'Phone' => 'phone',
        'Address' => 'address',
        'Zip' => 'zip',
        'Town' => 'city',
        'Supporting Member' => 'supporting',
        'Member ID'  => 'membrum_id',
        'cHaveLocker'  => 1,
        'cSum Member Object Fee'  => 'yearly_fee',
        'Creation Date'  => 'created_at',
        'Created By' => 'created_by',
        'Modification date'  => 'updated_at',
        'Modified by'  => 'updated_by',
        'cGenderFemale'  => 'female',
        'Board member' => 'board',
        'BSK' => 'bsk',
        'Ledare' => 'study_leader',
        'Ledarutbildning gjord datum' => 'study_leader_at',
    ];


}
