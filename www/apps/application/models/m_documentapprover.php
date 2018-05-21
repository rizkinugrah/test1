<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_documentapprover extends CI_Model{

  public function __construct() {
    parent::__construct();
  }

  public function update_document_approver($id, $documentReportId, $status){
    $this->db->set('status', $status);
    $this->db->where('id', $id);
    $this->db->where('documentReportId', $documentReportId);
    $update = $this->db->update('documentapprover');

    if($update){
      $countDocumentApprover = $this->db->where('documentReportId',$documentReportId)->from("documentapprover")->count_all_results();
      $countDocumentApproverApproved = $this->db->where('documentReportId',$documentReportId)->where('status','approved')->from("documentapprover")->count_all_results();

      if($countDocumentApprover == $countDocumentApproverApproved){
        $this->db->set('status', 'approved');
        $this->db->where('id', $documentReportId);
        $this->db->update('documentreports');
      } else {
        $this->db->set('status', 'need next approval');
        $this->db->where('id', $documentReportId);
        $this->db->update('documentreports');
      }
    }

    return $update;
  }

  // TODO: POST DATA
  public function post_data($data){
    unset($data['submit']);
    $insert = $this->db->insert('documentapprover', $data);
    return $insert;
  }

  // TODO: UPDATE DATA
  public function put_data($id, $data){
    unset($data['submit']);
    $this->db->where('id', $id);
    $update = $this->db->update('documentapprover', $data);
    return $update;
  }

  public function delete_data($id){
    $this->db->where('id', $id);
    $delete = $this->db->delete('documentapprover');
    return $delete;
  }

  // TODO: GET ALL DOCUMENT REPORTS ITEM
  public function get_list(){
    $this->db->select('*');
    $this->db->from('documentapprover');
    $query = $this->db->get();

    return $query->result();
  }

  // TODO: GET ALL DOCUMENT REPORTS ITEM BY REPORT ID
  public function get_list_by_documentreportid($documentReportId){
    $this->db->select('documentapprover.*, users.email');
    $this->db->from('documentapprover');
    $this->db->join('users', 'users.id = documentapprover.userId');
    $this->db->where('documentReportId', $documentReportId);
    $query = $this->db->get();

    return $query->result();
  }

  // TODO: GET SINGLE ROW BY ID
  public function get_detail($id){
    $this->db->select('*');
    $this->db->from('documentapprover');
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
