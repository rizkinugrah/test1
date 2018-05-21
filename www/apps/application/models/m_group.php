<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_group extends CI_Model{

  public function __construct() {
    parent::__construct();
  }

  public function get_list(){
    $this->db->select('*');
    $this->db->from('groups');
    $query = $this->db->get();

    return $query->result();
  }

  public function get_list_group(){
    $this->db->select('*');
    $this->db->from('groups');
    $this->db->where('id >', '1');
    $query = $this->db->get();

    return $query->result();
  }

  public function get_detail($id){
    $this->db->select('*');
    $this->db->from('groups');
    $this->db->where('id',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function get_group_permissions_list_by_group($id){
    $this->db->select('grouppermissions.id AS groupPermissionsId, permissions.*');
    $this->db->from('grouppermissions');
    $this->db->join('permissions AS permissions', 'permissions.id = grouppermissions.permissionId');
    $this->db->where('groupId', $id);
    $query = $this->db->get();

    return $query->result();
  }

  // TODO: POST DATA
  public function post_data($data){
    unset($data['submit']);

    $insert = $this->db->insert('groups', $data);
    return $insert;
  }

  public function put_data($id, $data){
    unset($data['submit']);
    $this->db->where('id', $id);
    $update = $this->db->update('groups', $data);
    return $update;
  }

  public function get_all_user_permissions($id){
    $this->db->select('users.*, permissions.codeName');
    $this->db->from('users AS users');
    $this->db->join('grouppermissions AS grouppermissions', 'grouppermissions.groupId = users.groupId');
    $this->db->join('permissions AS permissions', 'permissions.id = grouppermissions.permissionId');
    $this->db->where('users.id', $id);
    $query = $this->db->get();

    $result = $query->result();

    $userPermissionArray = array();
    foreach($result as $row){
      $userPermissionArray[] = $row->codeName;
    }

    return $userPermissionArray;
  }

  public function post_grouppermissions($data){
    unset($data['submit']);

    $insert = $this->db->insert('grouppermissions', $data);
    return $insert;
  }

  public function delete_grouppermissions($id){
    $delete = $this->db->delete('grouppermissions', array('id' => $id));
    return $delete;
  }

}
?>
