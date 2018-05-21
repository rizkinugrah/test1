<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_documentreportitem extends CI_Model{

  public function __construct() {
    parent::__construct();
  }

  // TODO: POST DATA
  public function post_data($data){
    unset($data['submit']);
    $insert = $this->db->insert('documentreportitems', $data);
    return $insert;
  }

  // TODO: UPDATE DATA
  public function put_data($id, $data){
    unset($data['submit']);
    $this->db->where('id', $id);
    $update = $this->db->update('documentreportitems', $data);
    return $update;
  }

  public function delete_data($id){
    $this->db->where('id', $id);
    $delete = $this->db->delete('documentreportitems');
    return $delete;
  }

  // TODO: GET ALL DOCUMENT REPORTS ITEM
  public function get_list(){
    $this->db->select('*');
    $this->db->from('documentreportitems');
    $query = $this->db->get();

    return $query->result();
  }

  // TODO: GET ALL DOCUMENT REPORTS ITEM BY REPORT ID
  public function get_list_by_documentreportid($documentReportId){
    $this->db->select('*');
    $this->db->from('documentreportitems');
    $this->db->where('documentReportId', $documentReportId);
    $query = $this->db->get();

    return $query->result();
  }

  // TODO: GET SINGLE ROW BY ID
  public function get_detail($id){
    $this->db->select('*');
    $this->db->from('documentreportitems');
    $this->db->where('id', $id);
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
