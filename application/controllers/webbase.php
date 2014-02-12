<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webbase extends CI_Controller {
  public $expirettl=array('5m'=>300,'15m'=>900,'30m'=>1800,'1h'=>3600,'3h'=>10800,'6h'=>21600,'9h'=>32400,'12h'=>43200,'1d'=>86400,'3d'=>253200,'5d'=>432000,'7d'=>604800);
  public $showimgapi = 'http://img.hacktea8.com/showpic.php?key=';
  protected $mem = '';
  protected $redis = '';
  public $viewData = array();
  protected $userInfo = array('uid'=>0,'uname'=>'','isvip'=>0);
  public $adminList = array(3);
  protected $isadmin = 0; 
  
  public function __construct(){
    parent::__construct();
    $this->load->library('memcache');
    $this->mem = &$this->memcache;
    $this->load->library('rediscache');
    $this->redis = &$this->rediscache;
    //解析UID
    $uid = getSynuserUid();
    if($uid){
      $uinfo = getSynuserInfo($uid);
    }
    //var_dump($uinfo);exit;
    //$this->userInfo = $this->usermodel->getUserInfo($uinfo);
    $this->assign(array('domain'=>$this->config->item('domain'),
                'base_url'=>$this->config->item('base_url'),'css_url'=>$this->config->item('css_url'),
                'admin_email'=>$this->config->item('admin_email'),'css_url'=>$this->config->item('css_url'),
                'img_url'=>$this->config->item('img_url'),'js_url'=>$this->config->item('js_url'),
                'toptips'=>$this->config->item('toptips'),'web_title'=>$this->config->item('web_title')
                ,'version'=>20140109,'login_url'=>$this->config->item('login_url'),'uinfo'=>$this->userInfo

    ));
  }
  
  public function checkLogin(){
    if(isset($this->userInfo['uid']) &&$this->userInfo['uid']>0){
      return true;
    }else{
      return false;
    }
  }
  public function checkIsadmin(){
    if(!$this->checkLogin()){
      redirect($this->config->item('login_url').$this->config->item('base_url'));
    }
    if(in_array($this->userInfo['groupid'],$this->adminList)){
      return true;
    }
    foreach($this->userInfo['groups'] as $gid){
      if(in_array($gid,$this->adminList)){
        return true;
      }
    }
      return false;
  }
  public function assign($data){
    foreach($data as $key => $val){
      $this->viewData[$key] = $val;
    }
  }
  public function view($view_file){
    $this->load->view('header', $this->viewData);
    $this->load->view($view_file);
    $this->load->view('footer');
  }
}