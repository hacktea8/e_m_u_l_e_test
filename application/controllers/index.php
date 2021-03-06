<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'usrbase.php';
class Index extends Usrbase {
  public function __construct(){
    parent::__construct();
  }
  public function index()
  {
    $c = $this->input->get('c');
    if('topic' == $c){
      $aid = $this->input->get('aid');
      $this->topic($aid);return true;
    }
    if('list' == $c){
      $cid = $this->input->get('cid');
      $this->lists($cid);return true;
    }
    $view = BASEPATH.'../';
    if(!is_writeable($view)){
       die($view.' is not write!');
    }
    $view .= 'index.html';
    $lock = $view . '.lock';
    if( !file_exists($view) || (time() - filemtime($view)) > 3*3600 ){
      if(!file_exists($lock)){
        
        $this->assign(array('_a'=>'index','emuleIndex'=>$this->mem->get('emutest-emuleIndexinfo')));
        if(empty($this->viewData['emuleIndex'])){
           touch($view);
           return 0;
        }
        $this->view('index_index');
        $output = $this->output->get_output();
        file_put_contents($lock, '');
        file_put_contents($view, $output);
        @unlink($lock);
        @chmod($view, 0777);
        echo $output;
        return true;
      }
    }
    exit();
  }
  public function setvipdown($page = 1){
    if( !isset($this->userInfo['uid']) || !$this->userInfo['uid']){
      header('Location: /');
    }
    $page = intval($page);
    $limit = 20;
    $lists = $this->emulemodel->getNoVIPDownList($limit);
    $this->assign(array(
    'infolist'=>$lists));
    $this->view('index_setvipdown');
  }
  public function fav($page = 1){
    if( !isset($this->userInfo['uid']) || !$this->userInfo['uid']){
      header('Location: /');
    }
    $page = intval($page);
    $limit = 30;
    $total = $this->emulemodel->getUserCollectTotal($this->userInfo['uid']);
    $endP = ceil($total/$limit);
    if($total && $endP >= $page){
      $lists = $this->emulemodel->getUserCollectList($this->userInfo['uid'],$order = 'new',$page,$limit);
    }
    $this->load->library('pagination');
    $config['base_url'] = sprintf('/index/collect/');
    $config['total_rows'] = $total;
    $config['per_page'] = 25;
    $config['first_link'] = '第一页';
    $config['next_link'] = '下一页';
    $config['prev_link'] = '上一页';
    $config['last_link'] = '最后一页';
    $config['cur_tag_open'] = '<span class="current">';
    $config['cur_tag_close'] = '</span>';
    $config['suffix'] = '.html';
    $config['use_page_numbers'] = TRUE;
    $config['num_links'] = 4;
    $config['cur_page'] = $page;

    $this->pagination->initialize($config);
    $page_string = $this->pagination->create_links();
    $this->assign(array(
    'page_string'=>$page_string,'infolist'=>$lists));
    $this->view('index_collect');
  }
 public function addCollect($aid = 0){
  $aid = intval($aid);
  $data = array('status'=>0);
  if($aid){
   if( !$this->userInfo['uid']){
    $data['status'] = -1;
   }
   $f = $this->emulemodel->addUserCollect($this->userInfo['uid'],$aid);
   $data['status'] = $f;
  }
  die(json_encode($data));
 }
  public function lists($cid,$order = 0,$page = 1){
    $page = intval($page);
    $cid = intval($cid);
    $cid = $cid < 1 ?1:$cid;
    $order = intval($order);
    $page = $page > 0 ? $page: 1;
    $scid = $cid;
    if(!$cinfo['pid']){
      foreach($this->viewData['channel'] as &$v){
        if($cid != $v['pid']){
          continue;
        }
        if($scid == $cid){
          $scid = $v['id'];
          break;
        }
      }
    }
    $cinfo = $this->viewData['channel'][$scid];
    $atotal = $cinfo['atotal'];
    if($page < 11){
       $data = array();
       $data['emulelist'] = $this->mem->get('emu-emulelist'.$scid.'-'.$page.$order);
       $data['postion'] = $this->mem->get('emu-listpostion'.$scid);
       if( empty($data['emulelist'])){
//die($this->expirettl['12h'].'empty');
         $data = $this->emulemodel->getArticleListByCid($scid,$order,$page);
//echo '<pre>';var_dump($data);exit;
         $this->mem->set('emu-emulelist'.$scid.'-'.$page.$order,$data['emulelist'],$this->expirettl['1h']);
         $this->mem->set('emu-listpostion'.$scid,$data['postion'],$this->expirettl['3h']);
       }
    }else{
       $data = $this->emulemodel->getArticleListByCid($scid,$order,$page);
    }
    $this->_rewrite_list_url($data['postion']);
    $this->_rewrite_article_url($data['emulelist']);
    $data['emulelist'] = is_array($data['emulelist']) ? $data['emulelist']: array();
    $cpid = isset($data['postion'][0]['id'])?$data['postion'][0]['id']:0;
    $this->load->library('pagination');
    $config['base_url'] = sprintf('/index/lists/%d/%d/',$cid,$order);
    $config['total_rows'] = $atotal;
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
// seo setting
    $title = $kw = '';
    foreach($data['postion'] as $row){
       $title .= $title ? '_' : '';
       $title .= $row['name'];
       $kw .= $row['name'].',';
    }
    $keywords = $kw.sprintf('ed2000.com,资源分享,ed2000资源共享,资源共享,ed2000,simplecd,ed,ed2k,人人影视,电驴');
  
    $this->assign(array('seo_title'=>$title,'seo_keywords'=>$keywords,'cpid'=>$cpid,'infolist'=>$data['emulelist'],'postion'=>$data['postion']
    ,'page_string'=>$page_string,'subcatelist'=>$data['subcatelist'],'cid'=>$cid));
    $this->view('index_lists');
  }
  public function topic($aid){
    $aid = intval($aid);
    if($aid <1){
      header('HTTP/1.1 301 Moved Permanently');
      header('Location: /');
      exit;
    }
    $data = $this->emulemodel->getEmuleTopicByAid($aid,$this->userInfo['uid'], $this->userInfo['isadmin'],0);
    if(empty($data['info'])){
      header('HTTP/1.1 301 Moved Permanently');
      header('Location: /');
      exit;
    }
    $data['info']['ptime']=date('Y:m:d', $data['info']['ptime']);
    $data['info']['utime'] = date('Y/m/d', $data['info']['utime']);
    $this->_rewrite_list_url($data['postion']);
    $this->_rewrite_article_url($data['info']);
    $data['info'] = $data['info'][0];
    $data['info']['relatdata'] = is_array($data['info']['relatdata']) ? $data['info']['relatdata'] : array();
    $data['info']['fav'] = 0;
    $cid = $data['info']['cid'] ? $data['info']['cid'] : 0;
    $cpid = isset($data['postion'][0]['id'])?$data['postion'][0]['id']:0;
// seo setting
    $kw = '';
    foreach($data['postion'] as $row){
       $kw .= $row['name'].',';
    }
    $channel = &$this->viewData['channel'];
    $cinfo = $channel[$cpid];
    
    $title = $data['info']['name'];
    $keywords = sprintf('%s,%s下载,%s电驴资源,%sed2k,%s网盘下载,%s种子,%s在线,%s%s下载',$title,$title,$title,$title,$title,$title,$title,$title,$cinfo['name']);
    $data['info']['intro'] = str_replace(array('www.ed2kers.com','emu.hacktea8.com'),array($this->viewData['domain'],$this->viewData['domain']),$data['info']['intro']);
    $data['info']['intro'] = preg_replace('#<a.*>#Uis','',$data['info']['intro']);
    $data['info']['intro'] = str_replace('</a>','',$data['info']['intro']);
    $seo_description = strip_tags($data['info']['intro']);
    $seo_description = preg_replace('#\s+#Uis','',$seo_description);
    $seo_description = mb_substr($seo_description,0,250);
    //$data['info']['downurl'] = str_replace('www.ed2kers.com',$this->viewData['domain'],$data['info']['downurl']);
    // not VIP Admin check verify
    $isCollect = 0;//$this->emulemodel->getUserIscollect($this->userInfo['uid'],$data['info']['id']);
    $right_hot = $this->mem->get('emu-right_hot'.$cid);
    $bottom_cold = $this->mem->get('emu-bottom_cold'.$cid);
    if(!$right_hot){
      $datas = $this->emulemodel->getArticleListByCid($cid,2,2,16);
      $right_hot = $datas['emulelist'];
      $this->_rewrite_article_url($right_hot);
      $datas = $this->emulemodel->getArticleListByCid($cid,1,2,16);
      $bottom_cold = $datas['emulelist'];
      $this->_rewrite_article_url($bottom_cold);
      $this->mem->set('emu-right_hot'.$cid,$right_hot,$this->expirettl['3h']);
      $this->mem->set('emu-bottom_cold'.$cid,$bottom_cold,$this->expirettl['3h']);
    }
  //  $_makehtml = $this->static_html;
    $this->assign(array('isCollect'=>$isCollect,'verifycode'=>$verifycode
    ,'seo_title'=>$title,'seo_keywords'=>$keywords,'cid'=>$cid,'cpid'=>$cpid
    ,'info'=>$data['info'],'postion'=>$data['postion'],'aid'=>$aid
    ,'right_hot'=>$right_hot,'bottom_cold'=>$bottom_cold
    ,'_makehtml'=>$this->static_html
    ,'seo_description'=>$seo_description
    ));
    $this->view('index_topic');
    if( !$this->robot && $this->static_html){
      $cache_file = CACHEDIR.($aid%10).'/'.$aid.'.html';
      $cache_dir = dirname($cache_file);
      makedir($cache_dir,0777);
      $output = $this->output->get_output();
      file_put_contents($cache_file,$output);
      @chmod($cache_file,0777);
    
    }
  }
 public function check_collect($aid = 0,$title = ''){
  $aid = intval($aid);
  $title = urldecode($title);
  $isCollect = 0;
  if($this->userInfo['uid'] && $aid){
   $isCollect = $this->emulemodel->getUserIscollect($this->userInfo['uid'],$aid);
  }
  $this->assign(compact('title','aid','isCollect'));
  $this->load->view('check_collect',$this->viewData);
 }
  public function search($q='',$type = 0,$order = 0,$page = 1){
    $q = $q ? $q:$this->input->get('q');
    $q = urldecode($q);
    $q = htmlentities($q);
    $page = intval($page);
    $page = $page -1;
    $page = $page < 0 ? 0: $page;
    $list = array();
    $pageSize = 12;
    if($q){
      $this->load->library('yunsearchapi');
      $opt = array('query'=>$q,'start'=>$page*$pageSize,'hits'=>$pageSize);
      $this->yunsearchapi->search($list,$opt);
      $hotKeywords = $this->yunsearchapi->getTopQuery($num=8,$days=30);
      //var_dump($hotKeywords);exit;
      if('OK' == $hotKeywords['status']){
         $hotKeywords = $hotKeywords['result']['items']['emu_hacktea8'];
      }
    }
    $page++;
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
    $config['per_page'] = $pageSize;
    $config['first_link'] = '第一页';
    $config['next_link'] = '下一页';
    $config['prev_link'] = '上一页';
    $config['last_link'] = '最后一页';
    $config['cur_tag_open'] = '<span class="current">';
    $config['cur_tag_close'] = '</span>';
    $config['suffix'] = '.html';
    $config['use_page_numbers'] = TRUE;
    $config['num_links'] = 4;
    $config['cur_page'] = $page;
    $this->pagination->initialize($config);
    $page_string = $this->pagination->create_links();
    $seo_title = sprintf('正在搜索%s第%d页',$q,$page);
    $this->assign(array('searchlist'=>$list['result'],'kw'=>$q,'q'=>$q
    ,'page_string'=>$page_string,'hot_search'=>$hot_search
    ,'recommen_topic'=>$recommen_topic,'hot_topic'=>$hot_topic
    ,'seo_title'=>$seo_title
    )); 
    $this->load->view('index_search',$this->viewData);
  }
  public function show404($goto = ''){
    $goto = '/';
    $this->assign(array('goto'=>$goto,'seo_title' =>'找不到您需要的页面..现在为您返回首页..'));
    $this->view('index_show404');
  }
  public function login(){
//var_dump($_SERVER);exit;
    $url = $this->viewData['login_url'].urlencode($_SERVER['HTTP_REFERER']);
//echo $url;exit;
    header('Location: '.$url);
    exit;
  }
  public function loginout(){
    $this->session->unset_userdata('user_logindata');
    setcookie('hk8_auth','',time()-3600,'/');
    $url = $_SERVER['HTTP_REFERER'];
//echo $url;exit;
    header('Location: '.$url);
    exit;
  }
  public function isUserInfo(){
    $data = array('status'=>0);
    if( isset($this->userInfo['uid']) && $this->userInfo['uid']){
       $data['status'] = 1;
    }
    die(json_encode($data));
  }
  
}
