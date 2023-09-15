<?php

namespace App\Models\Fortnox;

use App\Models\Fortnox\FortnoxVoucher;
use App\Models\Fortnox\IsFortnoxEntity;
use Illuminate\Database\Eloquent\Model;

class FortnoxVoucherRow extends Model
{
    use IsFortnoxEntity;

    protected $guarded=[];
    protected $fortnox_parent_field = 'fortnox_voucher_id';
    protected $fortnox_fields = [
        'account',
        'cost_center',
        'credit',
        'debit',
    ];
    public function invoice()
    {
        return $this->belongsTo(FortnoxVoucher::class, $this->fortnox_parent_field, 'id');
    }
}
