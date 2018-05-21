<?php

class Authorization extends CI_Model {
	private $tableUser;
	private $tableGroup;
	private $tablePermissions;
	private $tableGroupPermissions;

  public function __construct() {
  	$this->load->database();
  	$this->tableUser = 'users';
  	$this->tableGroup = 'group';
  	$this->tablePermissions = 'permissions';
  	$this->tableGroupPermissions = 'grouppermissions';
  }


}

?>
