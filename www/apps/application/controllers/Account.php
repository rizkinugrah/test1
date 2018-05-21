<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '../vendor/autoload.php';
use \Firebase\JWT\JWT;

class Account extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function login() {
		$this->data['title'] = "Login";
		if($this->session->userdata('loggedIn')){
      redirect(base_url('dashboard'));
		}

		$this->load->view('authentication/login',$this->data);
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('account/login', 'refresh');
	}

}
?>
