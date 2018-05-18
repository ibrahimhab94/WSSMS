<?php

namespace WSSMS\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model 
{

    protected $table = 'invoices';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('amount', 'user_id', 'customer_id');
    protected $visible = array('amount', 'user_id', 'customer_id');

}