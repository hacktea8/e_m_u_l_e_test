<?php
defined('BASEPATH') || exit('Forbidden');

if ( ! function_exists('article_url')){
  function article_url($aid,$site_url = ''){
    $return = sprintf('%s/topic-index-%d.html',$site_url,$aid);
    return $return;
  }
}

if ( ! function_exists('list_url')){
  function list_url($cid,$order,$page, $site_url = ''){
    $return = sprintf('%s/lists-%d-%d-%d.html', $site_url, $cid, $order, $page);
    return $return;
  }
}

if ( ! function_exists('index_url')){
  function index_url($site_url = ''){
    $return = sprintf('%s/index-index.html', $site_url);
    return $return;
  }
}

/*
if ( ! function_exists('')){
  function (){
    
    return $return;
  }
}
*/
?>
