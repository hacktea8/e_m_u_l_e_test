<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once 'webbase.php';
class Ajaxapi extends Webbase {


  public function __construct(){
    parent::__construct();
    $this->load->model('emulemodel');
  }
  
  public function getcate($cid = 0, $pid = 0){
    $return = array();
    if($pid == 0){
       $return = $this->mem->get('emu-rootCate');
    }elseif($pid && !$cid){
       $cateMap = $this->mem->get('emu-catemap');
       if(isset($cateMap[$pid])){
          $return = $cateMap[$pid];
       }else{
          $return = $this->emulemodel->getCateListByPid($pid,$limit = 0);
          if(is_array($cateMap)){
            $cateMap[$pid] = $return;
          }else{
            $cateMap = array($pid => $return);
          }
          $this->mem->set('emu-catemap', $cateMap, $this->expirettl['1d']);
       }
    }
    die(json_encode($return));
  }
}
