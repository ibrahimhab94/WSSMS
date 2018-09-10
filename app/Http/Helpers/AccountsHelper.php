<?php
/**
 * Created by PhpStorm.
 * User: ihaboush
 * Date: 9/10/18
 * Time: 4:20 PM
 */

namespace WSSMS\Http\Helpers;


trait AccountsHelper
{
    public function generateGroupId()
    {
        return 'GR-' . rand(1000, 9999);
    }

}