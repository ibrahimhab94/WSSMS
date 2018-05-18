<?php
namespace WSSMS\Http\Controllers;
use WSSMS\Traits\DBEncryption;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AuthController extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use DBEncryption;
    public function __construct(){
    }
    public function authenticate(Request $r){
        $redirectUrl = $this->DBFeild('de',$r->rdu);
        if(strstr($redirectUrl,'/login'))
            $redirectUrl = '/dashboard';
        if(Auth::attempt(['username'=>$r->input('username'),'password'=>$r->input('password')]))
            return redirect($redirectUrl);
        return $this->loginView()->with('RedirectUrl',$this->DBFeild('en',$redirectUrl()));

    }
    private function getRedirectUrl(){
        $redirectUrl = '/dashboard';
        return $redirectUrl;
    }
    public function loginView(){
        return view('auth.login_admin')->with('RedirectUrl',$this->DBFeild('en',$this->getRedirectUrl()));
    }
    public function logout(){
         Auth::logout();
         return redirect('/dashboard/login');
    }

}

?>
