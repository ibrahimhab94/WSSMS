<?php
/**
 * Created by PhpStorm.
 * User: ihaboush
 * Date: 9/10/18
 * Time: 4:04 PM
 */

namespace WSSMS\Model;


use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    public $timestamps = true;
    protected $table = 'accounts';
    protected $dates = ['deleted_at'];
    protected $fillable = [];
    protected $visible = [];


}