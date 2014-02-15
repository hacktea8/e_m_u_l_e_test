#!/usr/local/php/bin/php -q
<?php

$root=dirname(__FILE__).'/';
define('BASEPATH', $root.'../../');
//echo $root;exit;
require_once($root.'../grab/db.class.php');
require_once(BASEPATH.'application/helpers/rewrite_helper.php');

class model{
  public $db;
  public function __construct(){
    $this->db = new DB_MYSQL();
  }
  public function getList($page = 1,$limit = 100,$aid = 0){
    $start = ($page - 1) * $limit;
    $sql = sprintf('SELECT `id`,`utime` FROM `pw_emule_article` WHERE `flag`=1 AND `id`>%d  LIMIT %d,%d',$aid,$start,$limit);
     return $this->db->result_array($sql);
  }
  public function addIndex($data = array()){
    $sql = $this->db->insert_string($this->db->getTable('emule_sitemap'),$data);
    $this->db->query($sql); 
    return $this->db->insert_id();
  }
  public function getIndexList($type){
    $sql = sprintf('SELECT   `index` FROM `pw_emule_sitemap` WHERE `type`=%d',$type);
    return $this->db->result_array($sql);
  }
  public function getMaxAid($type){
    $sql = sprintf('SELECT   `index` FROM `pw_emule_sitemap` WHERE `type`=%d ORDER BY `id` DESC  LIMIT 1',$type);
    $row = $this->db->row_array($sql);
    return isset($row['index'])?$row['index']:0;
  }
}

$type = 1;
$base_url = 'http://emu.hacktea8.com/';
$model = new model();
$sitemap_index = '<?xml version="1.0" encoding="UTF-8"?>
   <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$index = 1;

$aid = $model->getMaxAid($type);
$count = 1;
$countLimit = 50000;
  $sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$tmp = '';
for($p = 1;;$p++){
 $list = $model->getList($p,150,$aid);
 foreach($list as $val){
   $tmp .= ' <url>
    <loc>'.$base_url.article_url($val['id']).'</loc>
    <lastmod>'.date('Y-m-d H:i:s',$val['utime']).'</lastmod>
    <changefreq>weekly</changefreq>
    </url>';
   if($count > $countLimit){
      $tmp = $sitemap.$tmp.'</urlset>';
      $index_file = BASEPATH.'google_sitemap'.$index.'.xml';
      file_put_contents($index_file,$sitemap);
      $model->addIndex(array('type'=>$type,'index'=>$index,'aid'=>$val['id'],'update'=>$val['utime']));
      $index++;
      $count = 0;
      $tmp = '';
sleep(5);
   }
   $count++;
  }
}
$indexList = $model->getIndexList($type);
for($i = 1; $i<=$index; $i++){
  $sitemap_index .= '<sitemap>
      <loc>'.$base_url.'google_sitemap'.$i.'.xml</loc>
      <lastmod>'.date('Y-m-d H:i:s').'</lastmod>
   </sitemap>';
}

$sitemap_index .= '</sitemapindex>';
file_put_contents(BASEPATH.'google_sitemap.xml',$sitemap_index);
echo "\n=== work success! ==\n";
?>
