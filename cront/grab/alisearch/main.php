<?php

$root = dirname(__FILE__);
define('BASEPATH',1);
require_once $root.'/model.php';
require_once $root.'/config.php';
require_once $root.'/../../../application/libraries/Yunsearchapi.php';
require_once $root.'/../../../application/helpers/rewrite_helper.php';

$search = new Yunsearchapi();
$model = new Model();
$count = 200;

while($count){
   $lists = $model->getNoneSearchLimit(5);
   if(empty($lists)){
     echo "\n==== List is Empty! =====\n";
     break;
   }
   echo "+++++ The Task is $count ++++++\n";
//var_dump($lists);exit;
   $_itemsArr = array();
   $idarr = array();
   foreach($lists as $val){
      $itemArr['id'] = 'emu_article_'.$val['id'];
      $itemArr['group_id'] = $val['uid'];
      $itemArr['title'] = $val['name'];
      $itemArr['cat'] = $val['cid'];
      $itemArr['tag'] = $val['keyword'];
      $itemArr['focus_count'] = $val['collectcount'];
      $itemArr['create_timestamp'] = $val['ptime'];
      $itemArr['update_timestamp'] = $val['utime'];
      $itemArr['body'] = trim(preg_replace('#\s+#is',' ',strip_tags($val['intro'])));
      $itemArr['body'] = mb_substr($itemArr['body'], 0, 256, 'utf-8');
//var_dump($val['intro']);
//var_dump($itemArr['body']);exit;
      $itemArr['thumbnail'] = 'http://img.hacktea8.com/showpic.php?key='.$val['cover'];
      $itemArr['hit_num'] = $val['hits'];
      $itemArr['url'] = article_url($val['id']);
      $_itemsArr[] = array('fields'=>$itemArr,'cmd'=>'ADD');;
      $idarr[] = $val['id'];
   }
//var_dump($_itemsArr);exit;
   $search->addDoc($_itemsArr);
   $model->setIsSearch($idarr);
   $count --;
}
  echo "执行完毕!\n";exit; 

