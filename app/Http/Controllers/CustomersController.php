<?php
/**
 * Created by PhpStorm.
 * User: ihaboush
 * Date: 3/8/18
 * Time: 1:10 PM
 */

namespace WSSMS\Http\Controllers;


use WSSMS\Model\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{   public static function getCustomers(){
        return Customer::all();
    }
    public function list(){
        $customers = CustomersController::getCustomers();
        return $this->v('dashboard.customers.list')->withCustomers($customers);
    }
    public function add_customer_json(Request $r){
        $data = [
            'name'=>$r->input('name'),
            'mobile'=>$r->input('mobile'),
            'phone'=>$r->input('phone'),
            'email'=>$r->input('email'),
            'address'=>$r->input('address'),
            'address_details'=>$r->input('address_full')
        ];
        $customer = new Customer;
        $customer->fill($data)->save();
        return ($customer);
        return (json_encode($r->all()));
    }
    public function update_customer(Request $r){
        $method = $r->input('method');
        if($method == 'get')
        return Customer::where('id',$r->input('id'))->get()->first();
        $data = [
            'name'=>$r->input('name'),
            'mobile'=>$r->input('mobile'),
            'phone'=>$r->input('phone'),
            'address'=>$r->input('address'),
            'email'=>$r->input('email'),
            'full_address'=>$r->input('full_address')
        ];
        $customer = Customer::where('id',$r->input('id'));
        $customer->update($data);
        return ['status'=>'ok'];
    }
}