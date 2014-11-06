<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webbase extends CI_Controller {
  public $expirettl=array('5m'=>300,'15m'=>900,'30m'=>1800,'1h'=>3600,'3h'=>10800,'6h'=>21600,'9h'=>32400,'12h'=>43200,'1d'=>86400,'3d'=>253200,'5d'=>432000,'7d'=>604800);
  public $showimgapi = 'http://i1.hacktea8.com/showpic.php?key=';
  protected $mem = '';
  protected $redis = '';
  public $viewData = array();
  protected $userInfo = array('uid'=>0,'uname'=>'','isvip'=>0,'isadmin'=>0);
  public $adminList = array(1);
  protected $_c = 'index'; 
  protected $_a = 'index'; 
  protected $static_html = '1'; 
  public $robot = 0;
  
  public function __construct(){
    parent::__construct();
    $this->load->library('memcached');
    $this->mem = &$this->memcached;
    $this->load->library('rediscache');
    $this->redis = &$this->rediscache;
    $session_uinfo = $this->session->userdata('user_logindata');
    //var_dump($session_uinfo);exit;
    if(empty($session_uinfo)){
      //解析UID
      $uinfo = getSynuserUid();
      if($uinfo){
        $this->userInfo['uname'] = $uinfo['uname'];
        $uinfo = getSynuserInfo($uinfo['uid']);
        $uinfo['uname'] = $this->userInfo['uname'];
        $uinfo = $this->usermodel->getUserInfo($uinfo);
        if($uinfo){
          $this->userInfo = array_merge($this->userInfo,$uinfo);
          $this->userInfo['isadmin'] = $this->checkIsadmin($return = 1);
          $this->session->set_userdata(array('user_logindata'=>$this->userInfo));
        }
      }
    }else{
      $this->userInfo = $session_uinfo;
    }
    //var_dump($this->userInfo);exit;
    $this->_c = $this->_get_c_a(1,'index');
    $this->_a = $this->_get_c_a(2,'index');
    $c = isset($_GET['c'])?$_GET['c']:'';
    if($c){
       $this->_a = 'list' == $c ? 'lists' : 'topic';
    }
    $current_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $this->checkIsrobot();
    $this->assign(array('domain'=>$this->config->item('domain'),
                'base_url'=>$this->config->item('base_url'),'css_url'=>$this->config->item('css_url'),
                'admin_email'=>$this->config->item('admin_email'),'errorimg'=>'/public/images/show404.jpg',
                'img_url'=>$this->config->item('img_url'),'js_url'=>$this->config->item('js_url'),
                'toptips'=>$this->config->item('toptips'),'web_title'=>$this->config->item('web_title')
                ,'version'=>20141031,'login_url'=>$this->config->item('login_url'),'uinfo'=>$this->userInfo
                ,'_c'=>$this->_c,'_a'=>$this->_a,'current_url'=>$current_url
    ));
  }
  
  protected function checkLogin(){
    if(isset($this->userInfo['uid']) &&$this->userInfo['uid']>0){
      return true;
    }else{
      return false;
    }
  }
  protected function checkIsadmin($return = 0){
    if( !($return || $this->checkLogin())){
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
  protected function assign($data){
    foreach($data as $key => $val){
      $this->viewData[$key] = $val;
    }
  }
  protected function view($view_file){
    $this->load->view('header', $this->viewData);
    $this->load->view($view_file);
    $this->load->view('footer');
  }
  public function _rewrite_list_url(&$list){
    foreach($list as &$v){
      $v['url'] = list_url($v['id'],0,1);
      if(isset($v['pid'])){
        $v['purl'] = list_url($v['pid'],0,1);
      }
    }
   
  }
  public function _rewrite_article_url(&$list){
    $list = isset($list[0]['id']) ? $list : array($list);
    foreach($list as &$v){
      $v['curl'] = list_url($v['cid'],0,1);
      $v['url'] = article_url($v['id']);
    }
  }
  protected function _getCateListById($cid = 0, $pid = 0){
    $return = array();
    if($cid){
       $return = $this->emulemodel->getAllSubcateByCid($cid,$limit = 0);
    }elseif($pid == 0){
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
    return $return;
  }
  protected function _get_c_a($index, $default = 'index'){
    $return = '';
    $return = $this->uri->segment($index, $default);
    $return = str_replace('.','', $return);
    return $return?$return:$default;
  }
  protected function checkIsrobot(){
    if( isset($_SERVER['HTTP_USER_AGENT']) && false !== stripos($_SERVER['HTTP_USER_AGENT'],'spider')){
      $this->robot = 1;
    }
  }
}
