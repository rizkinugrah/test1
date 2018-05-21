<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_user extends CI_Model{

  public function __construct() {
    parent::__construct();
  }

  public function is_valid($username){
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('username',$username);
    $this->db->or_where('email',$username);
    $query = $this->db->get();

    return $query->row();
  }

  public function is_valid_num($username){
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('username',$username);
    $query = $this->db->get();

    return $query->num_rows();
  }

  public function get_list(){
    $this->db->select('users.*, groups.name AS groupName');
    $this->db->from('users');
    $this->db->join('groups', 'groups.id = users.groupId');
    $query = $this->db->get();

    return $query->result();
  }

  public function get_list_kabag(){
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('groupId', 3);
    $query = $this->db->get();

    return $query->result();
  }

  // TODO: POST DATA
  public function post_data($data){
    unset($data['submit']);

    $insert = $this->db->insert('users', $data);
    return $insert;
  }

  public function is_unique_username($username){
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('username',$username);
    $query = $this->db->get();

    return $query->row();
  }

  public function is_unique_email($email){
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('email',$email);
    $query = $this->db->get();

    return $query->row();
  }

}
?>
