<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'webbase.php';
class Usrbase extends Webbase {
   
  public function __construct(){
    parent::__construct();
    
    $this->assign(array('seo_keywords'=>'','seo_description'=>'','seo_title'=>''));
  }
}
