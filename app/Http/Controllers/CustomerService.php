<?php

namespace WSSMS\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use WSSMS\Http\Helpers\CustomerServiceHelper;
use WSSMS\Http\Helpers\EmployeesHelper;
use Illuminate\Http\Request;
use WSSMS\Model\Customer;
use WSSMS\Model\CustomerServiceTicket;

class CustomerService extends Controller {

    protected $csh,$eh;

    public function __construct() {
        parent::__construct();
        $this->csh = new CustomerServiceHelper();
        $this->eh = new EmployeesHelper;
    }
    public function tickets() {
        return $this->v('dashboard.customer_service.tickets')->withCustomers(CustomersController::getCustomers())
                        ->with('waiting_tickets', $this->getTicketsByState([0,1,2,3])->get());
    }
    private function getTicketsByState($state = null){
        if(!is_array($state))
            if(is_numeric($state))
                $state = [$state];
            else return null;
            return CustomerServiceTicket::whereIn('status',$state);
    }
    public function insert(Request $r) {
        $ticket_no = $this->csh->generateTicketNo($r->input('ticket_type'));
        $customer = (object) [
                    'id' => $r->input('customer_id', null),
                    'name' => $r->input('customer_name', null),
                    'mobile' => $r->input('customer_mobile', null),
                    'address' => $r->input('customer_address', null)
        ];

        $c = Customer::where('id', $customer->id);
        if ($c->count() == 0)
            return ['status' => 'fail', 'msg' => __('ar.customers.not_exist')];
        //$c  = $c->first()->get();
        $init_state = $this->csh->getInitState();
        $data = [
            'customer_id' => $customer->id,
            'status' => 0,
            'customer_issue' => $r->input('customer_issue'),
            'customer_issue_details' => $r->input('customer_issue_details'),
            'customer_needed_time' => $this->csh->datetime($r, ['customer_wanted_date', 'customer_wanted_time']),
            'ticket_no' => $ticket_no,
            'customer_address' => $customer->address,
            'customer_full_address' => $r->input('customer_full_address'),
            'expected_needs' => $r->input('expected_needs'),
            'proirity' => 0,
            'ticket_type' => $r->input('ticket_type'),
            'contact_number' => $customer->mobile,
            'customer_call_time' => $this->csh->datetime($r, 'customer_call_time', 'd/m/Y h:i')
        ];
        //return $data;
        $cst = new CustomerServiceTicket;
        $cst->fill($data)->save();
        return ['status' => 'ok', 'ticket_no' => $ticket_no, 'id' => $cst->id, 'customer' => $customer, 'time' => $cst->customer_needed_time];
    }

    public function profile(Request $r) {
        $Customer = Customer::where('id', $r->input('id'))->first();
        $tickets_count = 23;
        return [
            'id' => $Customer->id,
            'avatar' => '/assets/img/avatars/sunny-big.png',
            'CustomerName' => $Customer->name,
            'TicketsCount' => $tickets_count,
            'CustomerRatio' => $this->csh->customer_rate($Customer->id),
            'mobile' => $Customer->mobile,
            'email' => $Customer->email,
            'address' => $Customer->address,
            'full_address' => $Customer->full_address,
        ];
    }

    public function getTicketData(Request $r) {
        $ticket_id = $r->input('id');
        $ticket_data = $this->csh->getTicketData($r->input('no'), $ticket_id);
        $customer_data = $this->csh->getCustomerByTicket($ticket_data);
        return [
            'ticket' => $ticket_data,
           'customer'=>$customer_data,
            'ticket_status'=>$this->csh->getTicketStatus($ticket_data),
            'ticket_status_text'=>__('ar.customerservice.ticket_status.'.$this->csh->getTicketStatus($ticket_data))
        ];
    }

    public function getEmployees() {
      $emps = \WSSMS\Model\Employee::all();
      $data  = [
        'data'=>[]
      ];
      foreach($emps as $emp)
      array_push($data['data'],[
        'name'=>$emp->name,
        'mobile'=>$emp->mobile,
        'status'=>$this->eh->getEmployeeData('status',$emp),
        'states'=>$this->eh->getEmployeeData('total/done',$emp),
        'crate'=> $this->eh->getEmployeeData('crate',$emp),
        'urate'=>$this->eh->getEmployeeData('urate',$emp),
        'activitys'=>$this->eh->getEmployeeData('activitys',$emp)['states'],//['in_day'=>4,'in_week'=>14,'in_month'=>46]
      ]);
      return $data;
    }
    public function getTicketStateView(Request $r){
        $location = $r->header()['referer'][0];
        $location = explode('/',$location);
        $location = last($location);
        return $location;
    }
    public function changeTicketState(Request $r){
        $t_id = $r->input('ticket_id');
        $user_state =  $r->input('next_state',null);
        $_t = CustomerServiceTicket::where('id',$t_id)->first();
        $current_state = $this->csh->ticketStatus($_t);
        if($user_state == null)
        $next_state = $this->csh->ticketStatus($current_state['next_state']);
        else $next_state = $user_state;
        $_t->update(['status'=>$next_state['key']]);
        return ['old_state'=>$current_state,'new_state'=>$next_state];
    }
    public function listEmployees(){
        return $this->v('dashboard.customer_service.employees');
    }
}
