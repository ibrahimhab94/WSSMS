<?php

namespace WSSMS\Model;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerServiceTicket extends Model 
{

    protected $table = 'cs_tickets';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('id','created_at','updated_at','deleted_at','user_id','customer_id','employee_id','leave_time','status','customer_issue','customer_needed_time','customer_issue_details','customer_call_time','customer_full_address','customer_address','expected_time','proirity','ticket_no','ticket_type','contact_number');
    protected $visible = array('id','created_at','updated_at','deleted_at','user_id','customer_id','employee_id','leave_time','status','customer_issue','customer_needed_time','customer_issue_details','customer_call_time','customer_full_address','customer_address','expected_time','proirity','ticket_no','ticket_type','contact_number');
    public function Customer(){
        return $this->belongsTo('\WSSMS\Model\Customer','customer_id');
    }
    public function getCustomerNeededTimeAttribute($value){
        try {
            return Carbon::createFromFormat('Y-m-d h:i:s',$value)->format('Y-m-d h:i');
        }catch(\Exception $e){
            return Carbon::today();
        }
    }

}