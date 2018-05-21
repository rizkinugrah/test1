<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  var $data;
	public function __construct()
	{
    parent::__construct();
    date_default_timezone_set("Asia/Jakarta");

		$this->load->model('m_group');
		$this->load->model('m_permission');

    if($this->session->userdata('isSuperAdmin')){
      $this->data['arrUserPermissions'] = $this->m_permission->get_all_permissions();
    } else {
      $this->data['arrUserPermissions'] = $this->m_group->get_all_user_permissions($this->session->userdata('userId'));
    }

    if(!$this->session->userdata('loggedIn')){
      redirect(base_url('account/login'));
		}
	}

  public function checkPermissions($permissionsRequired = null){
    $arrUserPermissions = $this->data['arrUserPermissions'];

    $isAllowed = False;
    if($permissionsRequired !== null) {
      foreach ($permissionsRequired as $key => $value) {
        if (in_array($value, $arrUserPermissions)){
          $isAllowed = True;
        }
      }
    } else {
      $isAllowed = True;
    }

    if(!$isAllowed){
      show_error("You're not authorized to perform this action.", 401, $heading = 'An Error Was Encountered');
    }
  }
}
