<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PulsaBuyModel extends Model
{
    protected $table = 'trans_voucher';

    protected $fillable = [
        'id', 'user_id', 'nominal_id', 'operator_id', 'no_hp', 'status', 'sent', 'pay_methode'
    ];

    public function nominal()
    {
        return $this->belongsTo('App\Models\NominalModel');
    }

    public function operator()
    {
        return $this->belongsTo('App\Models\OperatorModel');
    }

    const PROCCESS = 'Proccess';
    const SUCCESS = 'Success';
    const FAILED = 'Failed';
}