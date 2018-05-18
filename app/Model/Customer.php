<?php

namespace WSSMS\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model 
{

    protected $table = 'customers';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'mobile', 'email', 'alternative_mobile', 'phone', 'address');
    protected $visible = array('name', 'mobile', 'email', 'alternative_mobile', 'phone', 'address','id');
    
}