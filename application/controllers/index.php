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
//var_dump($this->viewData);exit;
  }
  public function index()
  {
    $c = isset($_GET['c'])?$_GET['c']:'';
    if('topic' == $c){
      $aid = isset($_GET['aid'])?$_GET['aid']:'';
      $this->topic($aid);return true;
    }
    if('list' == $c){
      $cid = isset($_GET['cid'])?$_GET['cid']:'';
      $this->lists($cid);return true;
    }
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
      @chmod($view, 0777);
      exit;
    }
    
    echo $output;
  }
  public function lists($cid,$order = 0,$page = 1){
    $page = intval($page);
    $page = $page > 0 ? $page: 1;
    if($page < 11){
       $data = array();
       $data['emulelist'] = $this->mem->get('emu-emulelist'.$cid.'-'.$page.$order);
       $data['atotal'] = $this->mem->get('emu-listatotal'.$cid);
       $data['subcatelist'] = $this->mem->get('emu-listsubcatelist'.$cid);
       $data['postion'] = $this->mem->get('emu-listpostion'.$cid);
       if( empty($data['emulelist'])){
//die($this->expirettl['12h'].'empty');
         $data = $this->emulemodel->getArticleListByCid($cid,$order,$page);
         $this->_rewrite_list_url($data['postion']);
         $this->_rewrite_list_url($data['subcatelist']);
         $this->_rewrite_article_url($data['emulelist']);
//echo '<pre>';var_dump($data);exit;
         $this->mem->set('emu-emulelist'.$cid.'-'.$page.$order,$data['emulelist'],$this->expirettl['7d']);
         $this->mem->set('emu-listatotal'.$cid,$data['atotal'],$this->expirettl['7d']);
         $this->mem->set('emu-listsubcatelist'.$cid,$data['subcatelist'],$this->expirettl['7d']);
         $this->mem->set('emu-listpostion'.$cid,$data['postion'],$this->expirettl['7d']);
       }
    }else{
       $data = $this->emulemodel->getArticleListByCid($cid,$order,$page);
    }
    $data['emulelist'] = is_array($data['emulelist']) ? $data['emulelist']: array();
//var_dump($data);exit;
    $this->load->library('pagination');
    $config['base_url'] = sprintf('/index/lists/%d/%d/',$cid,$order);
    $config['total_rows'] = $data['atotal'];
    $config['per_page'] = 25; 
    $config['first_link'] = '第一页'; 
    $config['next_link'] = '下一页';
    $config['prev_link'] = '上一页';
    $config['last_link'] = '最后一页';
    $config['cur_tag_open'] = '<span class="current">';
    $config['cur_tag_close'] = '</span>';
    $config['suffix'] = '.html';
    $config['use_page_numbers'] = TRUE;
    $config['num_links'] = 5;
    $config['cur_page'] = $page;
    $this->pagination->initialize($config); 
    $page_string = $this->pagination->create_links();
    $this->assign(array('infolist'=>$data['emulelist'],'postion'=>$data['postion']
    ,'page_string'=>$page_string,'subcatelist'=>$data['subcatelist'],'cid'=>$cid));
    $this->view('index_lists');
  }
  public function topic($aid){
    $data = $this->emulemodel->getEmuleTopicByAid($aid,$this->userInfo['uid'], $this->userInfo['isadmin']);
    $data['info']['ptime']=date('Y:m:d', $data['info']['ptime']);
    $data['info']['utime'] = date('Y/m/d', $data['info']['utime']);
//var_dump($data['postion']);exit;
    $this->_rewrite_list_url($data['postion']);
    $this->_rewrite_article_url($data['info']);
    $data['info'] = $data['info'][0];
    $data['info']['relatdata'] = is_array($data['info']['relatdata']) ? $data['info']['relatdata'] : array();
    $data['info']['fav'] = 0;
    $this->assign(array('info'=>$data['info'],'postion'=>$data['postion'],'aid'=>$aid)); 
    $ip = $this->input->ip_address();
    $key = sprintf('emuhitslog:%s:%d',$ip,$aid);
//var_dump($this->redis->exists($key));exit;
    if(!$this->redis->exists($key)){
       $this->redis->set($key, 1, $this->expirettl['6h']);
    }
    $this->view('index_topic');
  }
  public function tpl(){
    $this->load->view('index_tpl',$this->viewData);
  }
  public function search($q='',$type = 0,$order = 0,$page = 1){
    $q = $q ? $q:$_GET['q'];
    $q = urldecode($q);
    $page = intval($page);
    $page = $page < 1 ? 1: $page;
    $list = array();
    if($q){
      $param = array('kw' => $q, 'page' => $page, 'page_size' => 20);
      if(1 == $type){
        $param[] = '';
      }elseif(2 == $type){
        $param[] = '';
      }
      $this->load->library('aliyunsearchapi');
      $this->aliyunsearchapi->getsearch($list, $type, $param);
    }
    $hot_search = array();
    $recommen_topic = array();
    $recommen_topic[1] = array();
    $recommen_topic[2] = array();
    $hot_topic = array();
    $hot_topic['hit'] = array();
    $hot_topic['focus'] = array();
    $this->load->library('pagination');
    $config['base_url'] = sprintf('/index/search/%s/%d/%d/',urlencode($q),$type,$order);
    $config['total_rows'] = $list['result']['viewtotal'];
    $config['per_page'] = 25;
    $config['first_link'] = '第一页';
    $config['next_link'] = '下一页';
    $config['prev_link'] = '上一页';
    $config['last_link'] = '最后一页';
    $config['cur_tag_open'] = '<span class="current">';
    $config['cur_tag_close'] = '</span>';
    $config['suffix'] = '.html';
    $config['use_page_numbers'] = TRUE;
    $config['num_links'] = 5;
    $config['cur_page'] = $page;
    $this->pagination->initialize($config);
    $page_string = $this->pagination->create_links();
    $this->assign(array('searchlist'=>$list['result'],'kw'=>$q,'q'=>$q,'page_string'=>$page_string,'hot_search'=>$hot_search,'recommen_topic'=>$recommen_topic,'hot_topic'=>$hot_topic)); 
    $this->load->view('index_search',$this->viewData);
  }
  public function show404($goto = ''){
    $goto = '/';
    $this->assign(array('goto'=>$goto,'seo_title' =>'找不到您需要的页面..现在为您返回首页..'));
    $this->view('index_show404');
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
