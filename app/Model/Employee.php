<?php

namespace WSSMS\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model 
{

    protected $table = 'employees';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'mobile', 'phone', 'status');
    protected $visible = array('name', 'mobile', 'phone', 'status');

}