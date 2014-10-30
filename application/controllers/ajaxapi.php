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
    $key = sprintf('user_topic_hits_check:%s:%d',$ip,$aid);
//var_dump($this->redis->exists($key));exit;
    if( $this->redis->exists($key)){
      return 1;
    }
    
    $this->redis->set($key, 1, $this->expirettl['1d']);
    $key = sprintf('user_topic_hits:%d',$aid);
    $this->redis->incr($key);
  }
}
