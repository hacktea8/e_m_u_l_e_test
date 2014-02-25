<?php

$root = dirname(__FILE__).'/';

require_once $root.'../model.php';

$model = new Model();

for($page = 1;;$page++){
  $list = $model->getArticleList($page, $limit = 50){
  if(empty($list)){
    echo "===  ====";break;
  }

  foreach($list as $data){
    
    exit;

    $model->update_article_contents($data );
  }

  sleep(5);
}

