<?php

namespace App\Models\Fortnox;

use App\Models\Fortnox\IsFortnoxEntity;
use Illuminate\Database\Eloquent\Model;

class FortnoxCustomer extends Model
{
    use IsFortnoxEntity;

    protected $fortnox_key_field='customer_number';
    protected $completeFortnoxItems = true;
    protected $guarded=[];
    protected $fortnox_fields = [
        'customer_number',
        'address1',
        'address2',
        'zip_code',
        'city',
        'email',
        'email_invoice',
        'email_invoice_c_c',
        'country_code',
        'currency',
        'name',
        'your_reference',
        'organisation_number',
        'phone1',
        'phone2',
        'price_list',
        'terms_of_payment',
        'show_price_v_a_t_included',
        'default_delivery_types',
        'v_a_t_type',
        'v_a_t_number',
        'type',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->default_delivery_types = [
                'Invoice' => 'EMAIL',
                'Order' => 'EMAIL',
                'Offer' => 'EMAIL',
            ];
        });
    }

    public function getVatNumberAttribute()
    {
        return $this->attributes['v_a_t_number'] ?? '';
    }

    public function setVatNumberAttribute($value)
    {
        $this->attributes['v_a_t_number'] = $value;
    }

    public function getVatTypeAttribute()
    {
        return $this->attributes['v_a_t_type'] ?? '';
    }

    public function setVatTypeAttribute($value)
    {
        $this->attributes['v_a_t_type'] = $value;
    }

    public function getEmailInvoiceCcAttribute()
    {
        return $this->attributes['email_invoice_c_c'] ?? '';
    }

    public function setEmailInvoiceCcAttribute($value)
    {
        $this->attributes['email_invoice_c_c'] = $value;
    }

    public function getDefaultDeliveryTypesAttribute()
    {
        return unserialize($this->attributes['default_delivery_types']);
    }

    public function setDefaultDeliveryTypesAttribute($value)
    {
        return $this->attributes['default_delivery_types'] = serialize($value);
    }
}
