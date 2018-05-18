<?php
/**
 * Created by PhpStorm.
 * User: ihaboush
 * Date: 3/1/18
 * Time: 12:26 PM
 */

namespace WSSMS\Http\Helpers;


trait Nullable
{
    /**
     * @return nulled
     */
    public function nullledClass():nulled {
        return new nulled();
    }
}
class nulled{
    public function __call($name, $arguments)
    {
    }
    public static function __callStatic($name, $arguments)
    {
    }
}