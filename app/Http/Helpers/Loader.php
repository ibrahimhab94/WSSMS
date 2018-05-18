<?php
/**
 * Created by PhpStorm.
 * User: ihaboush
 * Date: 3/1/18
 * Time: 12:34 PM
 */

namespace WSSMS\Http\Helpers;


use Illuminate\Support\Facades\App;

trait Loader
{
    function setSettings():void{

    }
    function loadLocal($local):void{
        App::setLocale($local);
    }
    public function v($view){
        //dd($this->data['__Carbon']()->getTimeZone());

        return view($view)->with($this->viewAssist())->with($this->data);
    }
    public function viewAssist() : array{
        return [
            '_site'=>['title'=>'عالم الستلايت'],
            '_ribbon'=>$this->getRibbon(),
        ];
    }
    protected function getRibbon():array{
       // dd(__(App::getLocale().".".last(explode('\\',get_class($this)))));
        return [];
    }
}