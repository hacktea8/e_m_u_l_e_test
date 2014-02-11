<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'usrbase.php';
class Index extends Usrbase {
   
	/**
	 * Index Page for this controller.
	 *
	 */
  public function __construct(){
    parent::__construct();
    $this->load->model('indexmodel');
  }
  public function index()
  {
    $this->view('index_index');
  }
  public function tpl(){
    $this->load->view('index_tpl',$this->viewData);
  }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
