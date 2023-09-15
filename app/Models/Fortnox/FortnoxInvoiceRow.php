<?php

namespace App\Models\Fortnox;

use App\Models\Fortnox\FortnoxInvoice;
use App\Models\Fortnox\IsFortnoxEntity;
use Illuminate\Database\Eloquent\Model;

class FortnoxInvoiceRow extends Model
{
    use IsFortnoxEntity;

    protected $fortnox_parent_field = 'fortnox_invoice_id';
    protected $fortnox_fields = [
        'article_number',
        'cost_center',
        'delivered_quantity',
        'description',
        'price',
    ];
    protected $guarded=[];

    public function invoice()
    {
        return $this->belongsTo(FortnoxInvoice::class, $this->fortnox_parent_field, 'id');
    }

}
