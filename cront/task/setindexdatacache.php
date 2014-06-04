#!/usr/local/php/bin/php -q
<?php

$root=dirname(__FILE__).'/';
define('BASEPATH', $root.'../../');
//echo $root;exit;
require_once($root.'../grab/db.class.php');
require_once($root.'../../application/libraries/memcache.php');
require_once($root.'../../application/helpers/rewrite_helper.php');

$model=new model();
/*
$data = $model->getMemData();
$l = strlen(serialize($data));
$h = strlen(json_encode($data));
echo $l,' | h',$h,"\n";exit;
$s = $model->getMemStatus();
print_r($s);exit;
*/
$model->getIndexData();

class model{
  protected $db;
  public $emuleIndex=array();
  protected $mem;

  function __construct(){
    $this->db=new DB_MYSQL();
    $this->mem=new Memcache();
  }
  function getMemData(){
    $data = $this->mem->get('emutest-emuleIndexinfo');
    return $data;
  }
  function getMemStatus(){
    return $this->mem->get_status();
  }
  function getArticleListByCid($cid,$order,$page,$limit){
    switch($order){
      case 1:
      $order=' ORDER BY a.hits ASC ';
      //$order=' ORDER BY a.ptime ASC ';
      break;
      case 2:
      $order=' ORDER BY a.hits DESC ';
      //$order=' ORDER BY a.ptime DESC ';
      break;
      default:
      $order=' ORDER BY a.ptime DESC ';
   }
   $page=intval($page)-1;
   $page=$page>-1?$page:0;
   $limit=intval($limit);
   $page*=$limit;
   if($cid){
/*
      $cids=$this->getAllCateidsByCid($cid);
      $cids=implode(',',$cids);
      $where=' a.`cid` in ('.$cids.') AND ';
*/
      $where=' a.`cid`='.$cid.' AND ';
   }
   $sql=sprintf("SELECT a.`id`, a.`cid`, a.`uid`, a.`name`, a.`ptime`, a.`utime`, a.`cover`, a.`hits` FROM ".$this->db->getTable('emule_article')." as a WHERE %s a.`flag`=1 %s LIMIT %d,$limit",$where,$order,$page);
   $list = $this->db->result_array($sql);
   if( !is_array($list)){
      return array();
   }
   foreach($list as &$v){
     $v['url'] = article_url($v['id']);
   }
   return $list;
  }
  function getAllCateidsByCid($cid){
    $sql=sprintf('SELECT `id` FROM '.$this->db->getTable('emule_cate').' WHERE `pid`=%d AND `flag`=1',$cid);
    $cate=$this->db->result_array($sql);
    $res=array();
    if(is_array($cate)){
      foreach($cate as $val){
        $res[]=$val['id'];
      }
    }
    $res=count($res)?$res:array($cid);
    return $res;
  }
  function getrootCate(){
    $sql=sprintf('SELECT `id`,`name` FROM '.$this->db->getTable('emule_cate').' WHERE `pid`=0 AND `flag`=1');
    $list = $this->db->result_array($sql);
    if( !is_array($list)){
      return array();
    }
    foreach($list as &$v){
      $v['url'] = list_url($v['id'],0,1);
    }
    return $list;
  }
  function getAllSubcateByCid($cid,$limit=0){
    $sql=sprintf('SELECT `id`, `pid`, `name`, `atotal` FROM '.$this->db->getTable('emule_cate').' WHERE `id`=%d AND `flag`=1',$cid);
    $subinfo=$this->db->row_array($sql);
    if($subinfo['pid']){
       $cid=$subinfo['pid'];
    }
    $limit=intval($limit);
    $limit=$limit?' ORDER BY atotal DESC LIMIT '.$limit:'';
    $sql=sprintf('SELECT `id`, `pid`, `name`, `atotal` FROM '.$this->db->getTable('emule_cate').' WHERE `pid`=%d AND `flag`=1 %s',$cid,$limit);
    $list = $this->db->result_array($sql);
    if( !is_array($list)){
      return array();
    }
    foreach($list as &$v){
      $v['url'] = list_url($v['id'],0,1);
    }
    return $list;
  }
  function getIndexData(){
    $this->emuleIndex['new']=$this->getArticleListByCid(0,0,1,15);
sleep(2);
    $this->emuleIndex['hot']=$this->getArticleListByCid(0,2,1,15);
sleep(2);
    $this->emuleIndex['rand']=$this->getArticleListByCid(0,1,1,15);
sleep(2);

    $rootCate=$this->getrootCate();
    $list=array();
    foreach($rootCate as $cate){
sleep(2);
      $subcate=$this->getAllSubcateByCid($cate['id'],13);
      $pcid = $subcate[0]['id'];
      $list=$this->getArticleListByCid($pcid,2,1,13);
//echo '<pre>';var_dump($list);exit;
      $this->emuleIndex['catehot'][]=array('name'=>$cate['name'],'id'=>$cate['id'],'list'=>$list,'url'=>list_url($cate['id']));
        //List article
sleep(2);
        $list=array();
        foreach($subcate as $val){
sleep(2);
          $list[]=$this->getArticleListByCid($val['id'],0,1,15);
        }
        $this->emuleIndex['topiclist'][]=array('rand'=>$this->getArticleListByCid($pcid,1,1,20),'subcate'=>array('cate'=>$subcate,'list'=>$list));

    }

$this->mem->set('emutest-emuleIndexinfo',$this->emuleIndex,691200);

  }
  
}
