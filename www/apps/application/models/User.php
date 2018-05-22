<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model{

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

}
?>
