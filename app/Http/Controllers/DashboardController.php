<?php
/**
 * Created by PhpStorm.
 * User: ihaboush
 * Date: 3/2/18
 * Time: 12:54 AM
 */

namespace WSSMS\Http\Controllers;


use WSSMS\Providers\AppServiceProvider;

class DashboardController extends Controller
{
    public function dashboard(){
        return $this->v('dashboard.dashboard');
    }
}