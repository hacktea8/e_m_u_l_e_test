<?php
define('ROOTPATH',$APPPATH.'../');
require_once ROOTPATH.'phpCurl.php';

$apicurl = new phpCurl();
$apicurl->config['cookie'] = 'cookie_api';

function checkArticleByOname($oname){
  global $apicurl,$POST_API;
  $url = $POST_API.'checkArticleByOname';
  $apicurl->config['url'] = $url;
  $apicurl->postVal = array(
  'oname' => $oname
  );
  $html = $apicurl->getHtml();
  $return = json_decode($html,1);
//var_dump($return);exit;
  return $return;
}
function addArticle($data){
  global $apicurl,$POST_API;
  $url = $POST_API.'addArticleInfo';
  $apicurl->config['url'] = $url;
  $apicurl->postVal = array(
  'article_data' => json_encode($data)
  );
  $error = json_last_error();
  if($error){
    var_dump($data);exit;
  }
  $html = $apicurl->getHtml();
//var_dump($html);exit;
  return json_decode($html,1);
}
if( !function_exists('getHtml')){
function getHtml($url){
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.3 (Windows; U; Windows NT 5.3; zh-TW; rv:1.9.3.25) Gecko/20110419 Firefox/3.7.12');
  // curl_setopt($curl, CURLOPT_PROXY ,"http://189.89.170.182:8080");
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
  return $tmpInfo;
}
 
}
function trimBOM ($contents) {
 $charset = array();
 $charset[1] = substr($contents, 0, 1);
 $charset[2] = substr($contents, 1, 1);
 $charset[3] = substr($contents, 2, 1);
 if (ord($charset[1]) == 239 && ord($charset[2]) == 187 && ord($charset[3]) == 191) {
   return substr($contents, 3);
 }
 return $contents;
}
