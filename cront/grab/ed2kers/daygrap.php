<?php

$APPPATH=dirname(__FILE__).'/';
$psize=10;
include_once($APPPATH.'../function.php');
include_once($APPPATH.'config.php');


/*=========== Update Cate Article Total =========*/
//updateCateatotal();exit;
/*=========== Get All Cate Info =================*/


/*============ Get Cate article =================*/

$res='excres.txt';

$lastgrab=basename(__FILE__);
$path=$APPPATH.'config/';

//$rootcate=$model->getCateInfoBypid(0);
if(0){
 getsubcatelist($subcate);
 $json = json_encode($subcate);
 file_put_contents($APPPATH.'subcate.json',$json);
 var_dump($subcate);exit;
}else{
 $subcate = file_get_contents($APPPATH.'subcate.json');
 $subcate = json_decode($subcate, 1);
}
$abort = 0;
$lastK = 0;

foreach($subcate as $k => $_cate){
 echo "\n===== Current Index $k  Cid $_cate[id]  Url $_cate[url] =======\n";
 if($abort && $k < $lastK){
  continue;
 }
 $lastgrab = $path.$_cate['id'].'_'.$lastgrab;
 //getCatearticle($_cate['id']);
 if(!$_cate['url']){
   continue;
 }
// var_dump($_cate);exit;
 getSubCatearticle($_cate);
 file_put_contents($res,"cate $_cate[id] 已抓取完毕!\r\n",FILE_APPEND);
 sleep(5);
}

//updateCateatotal();

?>
