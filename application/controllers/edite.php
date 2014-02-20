<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'usrbase.php';
class Edite extends Usrbase {
  public $_action = array('emuleTopicAdd');
  public $imguploadapiurl = 'http://img.hacktea8.com/imgapi/upload/?seq=';

  
        /**
         * Index Page for this controller.
         *
         */
  public function __construct(){
    parent::__construct();
//    $this->load->model('indexmodel');
    // check login 
  }
  public function index($type, $id = 0){
     if( !in_array($type, $this->_action)){
         die('1');
     }
     $this->$type($id);
  }
  public function deletes($type, $id){
    
  }
  protected function emuleTopicAdd($id = 0){
    $row = $this->input->post('row');
    if(isset($row['title'])){
//       $this->emulemodel->setEmuleTopicByAid($this->userInfo['uid'],$row,$this->userInfo['isadmin']);
    }
    $info = array();
    if($id){
       $info = $this->emulemodel->getEmuleTopicByAid($aid,$this->userInfo['uid'], $this->userInfo['isadmin']);
    }
    $this->assign(array('_a'=>'emuleTopicAdd','info'=>$info,'imguploadapiurl'=>$this->imguploadapiurl
    ,'postion'=>array(array('url'=>'#','name'=>'编辑'))
    ));
    $this->view('edite_emuleTopicAdd');
  }
}
