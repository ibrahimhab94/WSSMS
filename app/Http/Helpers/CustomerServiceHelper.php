<?php
/**
 * Created by PhpStorm.
 * User: ihaboush
 * Date: 3/12/18
 * Time: 8:58 PM
 */

namespace WSSMS\Http\Helpers;


use Illuminate\Http\Request;
use WSSMS\Http\Controllers\CustomersController;
use Illuminate\Support\Carbon;
use WSSMS\Model\CustomerServiceTicket;
use WSSMS\Model\Employee;
use Exception;

/**
 * Class CustomerServiceHelper
 * @package WSSMS\Http\Helpers
 */
class CustomerServiceHelper
{
    private $_CST = 'CST' , $_initState = 0;
    private $_states =  [
        0=>['key'=>0,'next_state'=>1,'state'=>'unconfirmed'],
        1=>['key'=>1,'next_state'=>4,'state'=>'waiting'],
        2=>['key'=>2,'next_state'=>1,'state'=>'edited'],
        3=>['key'=>3,'next_state'=>1,'state'=>'changed'],
        4=>['key'=>4,'next_state'=>5,'state'=>'running'],
        5=>['key'=>5,'next_state'=>6,'state'=>'wait_review'],
        6=>['key'=>6,'next_state'=>7,'state'=>'wait_rate'],
        7=>['key'=>7,'next_state'=>7,'state'=>'ended'],
        8=>['key'=>8,'next_state'=>3,'state'=>'reopened'],
    ];

    /**
     * @param int $ticket_type
     * @return string
     */
    public function generateTicketNo($ticket_type = 0){
        return $this->_CST.'-'.$ticket_type.'-'.Carbon::today()->format('Ymd')."-".rand(100,999);
    }

    /**
     * @return string
     */
    public function Customers(){
        return CustomersController::class;
    }

    /**
     * @param Request $r
     * @param array $arr
     * @return static
     */
    public function datetime(Request $r,  $parm = null,$format = null){
       if(gettype($parm) != 'array')
           return ( Carbon::createFromFormat($format,$r->input($parm)));
        $result = Carbon::createFromFormat(
            'd/m/Y',
            $r->input($parm[0])
            );
        $time = Carbon::createFromFormat(
            'h:i',
            $r->input($parm[1]));
       $result->setTime($time->hour,$time->minute);
        return $result;
    }
    public function customer_rate($id){
        return 100;
    }
    public function getTicketData($no,$id){
        $t = \WSSMS\Model\CustomerServiceTicket::where('id',$id)->where('ticket_no',$no)->firstOrFail();
        return $t;
    }
    public function getCustomerByTicket($ticket){
        if (!($ticket instanceof \WSSMS\Model\CustomerServiceTicket))
            throw new Exception ('$ticket Must be instace of CustomerServiceTicket Class');
        $customer = $ticket->Customer()->first();
        return $customer;
    }
    public function getTicketStatus($ticket){
        return $ticket->status;
    }
    public function ticketStatus($index = null){
        $states = $this->_states;
        if($index instanceof CustomerServiceTicket)
            return $this->ticketStatus($index->status);
        if($index !== null && is_numeric($index))
            if(array_key_exists($index,$states))
                return $states[$index];
        if(is_string($index))
            return $this->StatusByState($index);
        return $states;
    }
    public function StatusByState($state){
        if(!is_string($state))
            return false;
        foreach ($this->ticketStatus() as $key=>$st){
            if($state == $st['state'])
                return $this->ticketStatus()[$key];
        }
        return $this->ticketStatus();
        
    }

    public function getInitState()
    {
        return $this->_initState;
    }


}
