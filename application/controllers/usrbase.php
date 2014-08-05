<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'webbase.php';
class Usrbase extends Webbase {
  public $url404 = 'index/show404'; 
  public $seo_title = '首页'; 
  public $seo_keywords = '电驴资源,电驴资源网站,电驴资源下载,电驴资源搜索,电驴资源网,电驴资源网站,电驴下载,电骡资源,ed2k,eMule,电骡下载,emule 资源,电驴资源库,电驴共享,ed2000,ED2000资源共享';
  public $seo_description = '是一个综合的电驴资源网站，提供包含电影、电视剧、音乐、游戏、动漫、综艺、软件、资料、图书、教育等栏目电驴资源搜索、电驴下载服务。';
  public $imguploadapiurl = 'http://img.hacktea8.com/imgapi/upload/?seq=';
  public $language = 'zh';

  public function __construct(){
    parent::__construct();
    
    $this->load->helper('rewrite');
    $this->load->model('emulemodel');
    
    $hotTopic = array();
    if('lists' == $this->_a){
     $hotTopic = $this->mem->get('emu-hotTopic');
//var_dump($hotTopic);exit;
     if(empty($hotTopic)){
      $hotTopic = $this->emulemodel->getHotTopic();
      $this->_rewrite_article_url($hotTopic);
      $this->mem->set('emu-hotTopic',$hotTopic,$this->expirettl['12h']);
     }
    }
    $rootCate = $this->mem->get('emu-rootCate');
    if( empty($rootCate)){
      $rootCate = $this->emulemodel->getCateByCid(0);
      $this->_rewrite_list_url($rootCate);
      $this->mem->set('emu-rootCate',$rootCate,$this->expirettl['1d']);
    } 
    $channel = $this->mem->get('emu-channel');
    if( empty($channel)){
      $channel = $this->emulemodel->getChannels();
      $this->_rewrite_list_url($channel);
      $this->mem->set('emu-channel',$channel,$this->expirettl['1d']);
    } 
    $this->assign(array(
    'seo_keywords'=>$this->seo_keywords,'seo_description'=>$this->seo_description,'seo_title'=>$this->seo_title
    ,'showimgapi'=>$this->showimgapi,'error_img'=>$this->showimgapi.'3958009_0000671092.jpg','hotTopic'=>$hotTopic,'rootCate'=>$rootCate,'click_ad_link'=>''
    ,'cpid'=>0,'cid'=>0,'channel'=>$channel,'language'=>$this->language
    ,'editeUrl' => '/edite/index/emuleTopicAdd'
    ));
    $this->_get_postion();
    $this->_get_ads_link();
//var_dump($this->viewData);exit;
  }
  protected function _get_postion($postion = array()){
    $this->assign(array('postion'=>$postion));
  }
  protected function _get_ads_link(){
   $click_ad_link = '';
   $pos = mt_rand(1,5);
   $mod = date('w');
   $ad_status = $this->rand_num_status($mod,$pos);
   $dh = date('H');
   $flag = $dh >=7 && $dh<=18?1:0;
   $ad_key = 'ahref_click';
   if(0&& $flag && $ad_status && !isset($_COOKIE[$ad_key]) && in_array($this->_a,array('lists','topic'))){
    $host = $_SERVER['HTTP_HOST'];
    $url = sprintf("http://c.3808010.com/code1/cpc_0_1_1.asp?w=960&h=130&s_h=1&s_l=6&c1=CCCCCC&c2=c90000&c3=ffffff&pid=264232&u=204756&top=%s&err=&ref=%s/",$this->viewData['current_url'],$host);
    $referer = 'http://'.$this->viewData['current_url'];
    $default_opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.66 Safari/537.36\r\n".
    "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n".
    "Accept-Language: zh-cn,zh;q=0.8,en-us;q=0.5,en;q=0.3\r\n".
    "Cache-Control: max-age=0\r\n".
    $referer

  )
);
    $default = stream_context_get_default($default_opts);
    $context = stream_context_create($default_opts);
    $html =  file_get_contents($url, false, $context);
    preg_match_all('#<a .*href="([^"]+)"#Uis',$html,$match);
    $links = $match[1];
    $k = array_rand($links);
    $click_ad_link = $links[$k];
   }
    $this->assign(array('click_ad_link'=>$click_ad_link,'click_ad_dh'=>$dh));
    //echo $links[$k];exit;
  }
  protected function rand_num_status($mod = 0,$pos){
    $ad_status = 0;
    if(0 == $mod){
     if( in_array($pos,array(3,4,5))){
      $ad_status = 1;
     }
    }elseif(1 == $mod){
     if( in_array($pos,array(1,4,5))){
      $ad_status = 1;
     }
    }elseif(2 == $mod){
     if( in_array($pos,array(4,5))){
      $ad_status = 1;
     }
    }elseif(3 == $mod){
     if( in_array($pos,array(1,5))){
      $ad_status = 1;
     }
    }elseif(4 == $mod){
     if( in_array($pos,array(1,2,4))){
      $ad_status = 1;
     }
    }elseif(5 == $mod){
     if( in_array($pos,array(3,4))){
      $ad_status = 1;
     }
    }elseif(6 == $mod){
     if( in_array($pos,array(1,3,4))){
      $ad_status = 1;
     }
    }
    if($ad_status){
      return 1;
    }
    setcookie('ahref_click','1',time()+2*3600,'/');
    return 0;
  }
}
