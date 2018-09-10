<?php
/**
 * Created by PhpStorm.
 * User: ihaboush
 * Date: 9/3/18
 * Time: 1:00 PM
 */

namespace WSSMS\Http\Controllers;



use Illuminate\Http\Request;
use WSSMS\Http\Helpers\AccountsHelper;
use WSSMS\Model\AccountGroups;

class Accounting extends Controller
{
    use AccountsHelper;
    public function __construct()
    {
        parent::__construct();
    }
    public function tree(){
        return $this->v('dashboard.accounts.dashboard');
    }
    public function add_account(Request $r){
        return $r->all();
    }

    public function add_account_group(Request $r)
    {
        $group_name = $r->input('group_name');
        $super_group = $r->input('super_group');

        $super_group = AccountGroups::where('group_id', $super_group)->get();
        $super_group = !empty($super_group->toArray()) ? $super_group->id : null;
        $data = [
            'name' => $group_name,
            'group' => $super_group,
            'details' => '',
            'properties' => '',
            'group_id' => $this->generateGroupId()
        ];
        $group = AccountGroups::create($data);
        if ($group)
            return ['state' => true, 'data' => $data];
    }

    public function getAccountGroups(Request $r)
    {
        return [
            ['no' => '010023', 'name' => 'حسابات دائنة'],
            ['no' => '010025', 'name' => 'حسابات مدينة'],
            ['no' => '010028', 'name' => 'حسابات شيكل'],
            ['no' => '010029', 'name' => 'حسابات دولار'],
            ['no' => '010020', 'name' => 'حسابات دينار'],
            ['no' => '010032', 'name' => 'حسابات يورو'],
            ['no' => '010023', 'name' => 'حسابات جنيه استرليني'],
        ];
    }
}