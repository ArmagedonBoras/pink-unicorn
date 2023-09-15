<?php

namespace App\Models\Fortnox;

use App\Models\Fortnox\IsFortnoxEntity;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fortnox\FortnoxVoucherRow;

class FortnoxVoucher extends Model
{
    use IsFortnoxEntity;

    protected $fortnox_key_field='voucher_number';
    protected $guarded=[];
    protected $fortnox_relations= [
        'VoucherRows' => 'rows',
    ];
    protected $fortnox_fields = [
        'cost_center',
        'description',
        'transaction_date',
        'voucher_series',
    ];

    public function rows()
    {
        return $this->hasMany(FortnoxVoucherRow::class, 'fortnox_voucher_id', 'id');
    }
}
