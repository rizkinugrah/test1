<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_profile extends CI_Model{

  public function __construct() {
    parent::__construct();
  }

  // TODO: POST DATA
  public function post_data($data){
    unset($data['submit']);


    $insert = $this->db->insert('profiles', $data);
    return $insert;
  }

}
?>
