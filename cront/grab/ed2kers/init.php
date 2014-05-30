<?php

$APPPATH=dirname(__FILE__).'/';
include_once($APPPATH.'../db.class.php');

$pattern = '/ed2kers/grab.php';
require_once $APPPATH.'singleProcess.php';

$db=new DB_MYSQL();

for($p=0;;$p++){
$list = getnocoverlist($p);
if(empty($list)){
break;
}
foreach($list as $val){
echo "\nId: $val[id] cover: $val[cover]\n";
if(false != stripos($val['cover'],'.')){
  seterrcoverByid(1,$val['id']);
}
//exit;
}
sleep(5);
}

function getnocoverlist($page=0,$limit = 1000){
    global $db;
    $p = $page*$limit;
    $sql=sprintf('SELECT `id`,`cover` FROM %s WHERE `iscover`=0 LIMIT %d,%d',$db->getTable('emule_article'),$p,$limit);
    $res=$db->result_array($sql);
    return $res;
}

function seterrcoverByid($cover = '',$id = 0){
    if(!$id){
       return false;
    }
    global $db;
    $sql = sprintf('UPDATE %s SET `iscover`=%d WHERE `id`=%d LIMIT 1',$db->getTable('emule_article'),$cover,$id);
    $db->query($sql);
}
function setcoverByid($cover = '',$id = 0){
  $pos = stripos($cover,'.');
    if(!$id || !$pos){
       return false;
    }
    global $db;
    $sql = sprintf('UPDATE %s SET `cover`=\'%s\',`iscover`=1 WHERE `id`=%d LIMIT 1',$db->getTable('emule_article'),mysql_real_escape_string($cover),$id);
    $db->query($sql);
}
function getCover($url){
  $data['url'] = $url;
  $html = getHtml($data);
  preg_match('#<div class="litimg fLeft">\s*<img alt="[^"]+" src="([^"]+)"[^>]*></div>#Uis',$html,$match);
  $cover = $match[1];
//file_put_contents('cover_html.html',$html);
//echo $url;var_dump($cover);exit;
  return $cover;
}
function getHtml(&$data){
  $curl = curl_init();
  $url = $data['url'];
  unset($data['url']);
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.3 (Windows; U; Windows NT 5.3; zh-TW; rv:1.9.3.25) Gecko/20110419 Firefox/3.7.12');
  // curl_setopt($curl, CURLOPT_PROXY ,"http://189.89.170.182:8080");
  curl_setopt($curl, CURLOPT_POST, count($data));
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
  curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
  curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
  curl_setopt($curl, CURLOPT_HEADER, 0);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $tmpInfo = curl_exec($curl);
  if(curl_errno($curl)){
    echo 'error',curl_error($curl),"\r\n";
    return false;
  }
  curl_close($curl);
  $data['url'] = $url;
  return $tmpInfo;
}

