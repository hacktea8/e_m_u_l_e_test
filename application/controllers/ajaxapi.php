<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'webbase.php';
class Ajaxapi extends Webbase {


  public function __construct(){
    parent::__construct();
    //$this->load->model('emulemodel');
    if( !$this->input->is_ajax_request()){
      die(0);
    }
  }
  
  public function article_pv($aid){
    $ip = $this->input->ip_address();
    $key = sprintf('emuhitslog:%s:%d',$ip,$aid);
//var_dump($this->redis->exists($key));exit;
    if( !$this->redis->exists($key)){
       $this->redis->set($key, 1, $this->expirettl['1d']);
    }
  }
}
