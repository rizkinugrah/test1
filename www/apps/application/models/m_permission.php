<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_permission extends CI_Model{

  public function __construct() {
    parent::__construct();
  }

  public function get_all_permissions(){
    $this->db->select('*');
    $this->db->from('permissions');
    $this->db->where('id > ', 1);
    $query = $this->db->get();

    $result = $query->result();

    $userPermissionArray = array();
    foreach($result as $row){
      $userPermissionArray[] = $row->codeName;
    }

    return $userPermissionArray;
  }

  public function get_list($groupId){

    $queryPermissions = $this->db->select('*')->from('grouppermissions')->where('groupId', $groupId)->get();
    $result = $queryPermissions->result();
    $permissionArray = array();
    foreach($result as $row){
      $permissionArray[] = $row->permissionId;
    }
    $permissionsId = implode(",",$permissionArray);
    $ids = explode(",", $permissionsId);

    $this->db->select('*');
    $this->db->from('permissions');
    $this->db->where_not_in('id', $ids);
    $this->db->where('id > ', 1);
    $query = $this->db->get();

    return $query->result();
  }
}
?>
