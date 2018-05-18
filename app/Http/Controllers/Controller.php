<?php

namespace WSSMS\Http\Controllers;
use WSSMS\Http\Helpers\Loader;
use WSSMS\Http\Helpers\Nullable;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use WSSMS\Traits;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,Nullable,Loader;
    protected $data = ['user_data' => null];
    private $_auth;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->data['__Carbon'] = (function(){

            return new Carbon;
        });
      //  $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->data['__Auth'] = $this->_auth = Auth::user();
            $this->setSettings();
            $this->functions = $this->nullledClass();
            return $next($request);
        });
    }


}
