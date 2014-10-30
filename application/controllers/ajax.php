<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'webbase.php';
class Ajax extends Webbase {

 public function __construct(){
  parent::__construct();
  //$this->load->model('emulemodel');
  if( !$this->input->is_ajax_request()){
   die(0);
  }
 }
  
 public function convert_url(){
  $url = $this->input->post('url');
  $json = array('flag'=>0);
  if($url){
   $url = self::zhuanhuan($url);
   $json['flag'] = 1;
   $json['origin'] = $url;
   $json['thunder'] = "thunder://".base64_encode("AA".$url."ZZ");//base64加密，下面的2也一样
   $json['flashget'] = "Flashget://".base64_encode("[FLASHGET]".$url."[FLASHGET]")."&aiyh";
   $json['qqdl'] = "qqdl://".base64_encode($url);
  }
  die(json_encode($json));
 }
 static public function zhuanhuan($ourl){
  $urlodd = explode('//', $ourl,2);//把链接分成2段，//前面是第一段，后面的是第二段
  $head = strtolower($urlodd[0]);
  //PHP对大小写敏感，先统一转换成小写，不然 出现HtTp:或者ThUNDER:这种怪异的写法不好处理
  $behind = $urlodd[1];
  if($head == "thunder:"){
   $url = substr(base64_decode($behind), 2, -2);//base64解密，去掉前面的AA和后面ZZ
  }elseif($head == "flashget:"){
   $url1 = explode('&',$behind,2);
   $url = substr(base64_decode($url1[0]), 10, -10);//base64解密，去掉前面后的[FLASHGET]
  }elseif($head == "qqdl:"){
   $url = base64_decode($behind);//base64解密
  }elseif($head == "http:" ||$head == "ftp:" ||$head =="mms:" ||$head == "rtsp:" ||$head =="https:"){
   $url = $ourl;//常规地址仅支持http,https,ftp,mms,rtsp传输协议，其他地貌似很少，像XX网盘实际上也是基于base64，但是有的解密了也下载不了
  }else{
   $url = "本页面暂时不支持此协议";
  }
  return $url;
 }
}
