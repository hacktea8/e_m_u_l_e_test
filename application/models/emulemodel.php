<?php
require_once 'basemodel.php';
class emuleModel extends baseModel{
  
  public function __construct(){
     parent::__construct();
  }
  public function getHotTopic($order = 'hits',$limit=15){
     $order = $order ? ' `ptime` DESC ': ' `hits` DESC ';
     $sql   = sprintf('SELECT `id`, `name`, `thum`,`cover` FROM %s WHERE `flag`=1 ORDER BY %s LIMIT %d', $this->db->dbprefix('emule_article'), $order, $limit); 
     return $this->db->query($sql)->result_array();
  }
  public function getCateByCid($sub=0){
     if($sub){
       $sql = sprintf('SELECT `id`, `pid`, `name`, `atotal` FROM %s WHERE `flag` = 1',$this->db->dbprefix('emule_cate'));
       $list= $this->db->query($sql)->result_array();
       $res = array();
       foreach($list as $val){
         if($val['pid']==0){
           $res[$val['id']]['id']=$val['id'];
           $res[$val['id']]['name']=$val['name'];
           $res[$val['id']]['atotal']=$val['atotal'];
         }else{
           $res[$val['pid']]['subcate'][]=$val;
         }
       }
       return $res;
     }

     $sql = sprintf('SELECT `id`, `pid`, `name`, `atotal` FROM %s WHERE `pid` = 0 AND `flag` = 1',$this->db->dbprefix('emule_cate'));
     return $this->db->query($sql)->result_array();
  }
  public function getdata(){
     return 9999999;
  }
}
?>
