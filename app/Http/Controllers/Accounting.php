<?php
/**
 * Created by PhpStorm.
 * User: ihaboush
 * Date: 9/3/18
 * Time: 1:00 PM
 */

namespace WSSMS\Http\Controllers;


class Accounting extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function tree(){
        return $this->v('dashboard.accounts.dashboard');
    }
}