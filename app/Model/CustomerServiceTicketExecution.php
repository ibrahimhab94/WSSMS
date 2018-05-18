<?php

namespace WSSMS\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerServiceTicketExecution extends Model 
{

    protected $table = 'cstexecutions';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('ticket_id', 'user_id', 'leave_time', 'status', 'customer_detail', 'employee_details', 'arrive_time', 'customer_rate', 'employee_rate');
    protected $visible = array('ticket_id', 'user_id', 'leave_time', 'status', 'customer_detail', 'employee_details', 'arrive_time', 'customer_rate', 'employee_rate');

}