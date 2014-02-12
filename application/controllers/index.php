<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'usrbase.php';
class Index extends Usrbase {
   
	/**
	 * Index Page for this controller.
	 *
	 */
  public function __construct(){
    parent::__construct();
//    $this->load->model('indexmodel');
    $this->load->model('emulemodel');
    $hotTopic = $this->mem->get('emu-hotTopic');
//var_dump($hotTopic);exit;
    if(empty($hotTopic)){
//      $hotTopic = $this->emulemodel->gethotTopicinfo();
//      $this->mem->set('emu-hotTopic',$hotTopic,$this->expirettl['12h']);
    }
    $rootCate = $this->mem->get('emu-rootCate');
    if(empty($rootCate)){
  //    $rootCate = $this->emulemodel->getrootCateinfo();
  //    $this->mem->set('emu-rootCate',$rootCate,$this->expirettl['1d']);
    } 
    $this->assign(array(
    'seo_keywords'=>'','seo_description'=>'','seo_title'=>''
    ,'showimgapi'=>$this->showimgapi,'error_img'=>$this->showimgapi.'3958009_0000671092.jpg','hotTopic'=>$hotTopic,'rootCate'=>$rootCate,
    'thumhost'=>'http://i.ed2kers.com'
    ));
  }
  public function index()
  {
    $this->assign(array('emuleIndex'=>$this->mem->get('emutest-emuleIndexinfo')));
    $this->view('index_index');
    $output = $this->output->get_output();
    $view = BASEPATH.'../';
    if(!is_writeable($view)){
       die($view.' is not write!');
    }
    $view .= 'index.html';
    if( !file_exists($view) || (time() - filemtime($view)) > 24*3600 ){
      file_put_contents($view, $output);
    }
    
    echo $output;
  }
  public function lists(){
    
    $this->view('index_lists');
  }
  public function topic(){
    
    $this->view('index_topic');
  }
  public function tpl(){
    $this->load->view('index_tpl',$this->viewData);
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
