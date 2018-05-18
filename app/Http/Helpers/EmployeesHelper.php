<?php
namespace WSSMS\Http\Helpers;
use Exception;
use Illuminate\Support\Carbon;
use WSSMS\Model\Employee;
class EmployeesHelper {
  protected $args;
  public function __construct(){

  }
  protected function getStatus(Employee $emp){
      return __('ar.employees.status_list.0');
  }
  protected function getEmployeeActivites($emp,$options = null){
    if(empty($options) || $options == null)
      $options = ['period'=>false,'month'=>02];
      if($options['period'] != false && !is_array($options['period'] && empty($options['period'])))
      $options['period'] =false;
      return [
        'total'=>77,
        'done'=>32,
        'cancled'=>14,
        'fails'=>(77-32-14),
        'states'=>['in_day'=>3,'in_week'=>15,'in_month'=>73]
    ];
  }
  protected function getStates(Employee $emp,$period =''){
    $data =  $this->getEmployeeActivites($emp);
    return $data['states'];
  }
  protected function getRates(Employee $emp,$rt){
    return 4.56;
  }
  public function getEmployeeData($i,Employee $emp){
    switch ($i) {
      case 'status':
        return $this->getStatus($emp);
        break;
      case 'total/done':
        $d= $this->getEmployeeActivites($emp);
        return $d['total'] . " / " . $d['fails'];
      break;
      case 'urate':
        return $this->getRates($emp,'users');
      break;
      case 'crate':
        return $this->getRates($emp,'customers');
      break;
      default:
        return 0;
        break;
    }
  }
}
