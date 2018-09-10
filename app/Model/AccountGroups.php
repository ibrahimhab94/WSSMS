<?php
/**
 * Created by PhpStorm.
 * User: ihaboush
 * Date: 9/10/18
 * Time: 4:05 PM
 */

namespace WSSMS\Model;


use Illuminate\Database\Eloquent\Model;

class AccountGroups extends Model
{
    public $timestamps = true;
    protected $table = 'accgroups';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'details', 'properties', 'group_id', 'group'];
    protected $visible = ['name', 'details', 'properties', 'group_id', 'group'];
}