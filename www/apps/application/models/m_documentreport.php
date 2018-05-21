<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_documentreport extends CI_Model{

  public function __construct() {
    parent::__construct();
  }

  // TODO: POST DATA
  public function post_data($data){
    unset($data['submit']);
    $insert = $this->db->insert('documentreports', $data);
    return $insert;
  }

  // TODO: UPDATE DATA
  public function put_data($id, $data){
    unset($data['submit']);
    $this->db->where('id', $id);
    $update = $this->db->update('documentreports', $data);
    return $update;
  }

  public function delete_data($id){
    $this->db->where('id', $id);
    $delete = $this->db->delete('documentreports');
    return $delete;
  }

  // TODO: GET ALL DOCUMENT REPORTS
  public function get_list(){
    $this->db->select('documentreports.*, users.email');
    $this->db->from('documentreports');
    $this->db->join('users', 'users.id = documentreports.userId');
    $query = $this->db->get();

    return $query->result();
  }

  // TODO: GET ALL DOCUMENT REPORTS NEED TO BE VERIFY
  public function get_list_need_to_verify(){
    $this->db->select('documentreports.*, users.email');
    $this->db->from('documentreports');
    $this->db->join('users', 'users.id = documentreports.userId');
    $this->db->where('documentreports.status', 'submitted');
    $query = $this->db->get();

    return $query->result();
  }

  public function get_list_need_to_approval(){
    $this->db->select('documentapprover.id AS documentApproverId, documentapprover.status, documentreports.*, reportUser.email AS repoterUser, accUser.email AS accUser');
    $this->db->from('documentapprover');
    $this->db->join('documentreports', 'documentreports.id = documentapprover.documentReportId');
    $this->db->join('users AS reportUser', 'reportUser.id = documentreports.userId');
    $this->db->join('users AS accUser', 'accUser.id = documentapprover.userId');
    $this->db->where('documentapprover.status IS NULL', NULL, TRUE);
    $this->db->group_start();
    $this->db->where('documentreports.status', 'verified')->or_where('documentreports.status', 'need next approval');
    $this->db->group_end();
    $this->db->group_by("documentapprover.documentReportId");
    $query = $this->db->get();

    return $query->result();
  }

  // TODO: GET SINGLE ROW BY ID
  public function get_detail($id){
    $this->db->select('documentreports.*, users.email');
    $this->db->from('documentreports');
    $this->db->join('users as users', 'users.id = documentreports.userId');
    // $this->db->join('users as verifiedUsers', 'users.id = documentreports.verifiedUserId', 'left');
    $this->db->where('documentreports.id', $id);
    $query = $this->db->get();

    return $query->row();
  }

  public function update_document_report($id, $status){
    $this->db->set('status', $status);
    $this->db->where('id', $id);
    $update = $this->db->update('documentreports');
    return $update;
  }

  public function mark_as_verified_document_report($id){
    $this->db->set('documentStatus', 'verified');
    $this->db->set('isVerified', true);
    $this->db->set('verifiedUserId', $this->session->userdata("userId"));
    $this->db->set('verifiedTimestamp', date("Y-m-d H:i:s"));
    $this->db->where('id', $id);
    $update = $this->db->update('documentreports');
    return $update;
  }

  public function mark_as_revised_document_report($id, $description){
    $this->db->set('documentStatus', 'revised');
    $this->db->set('revisedDescription', $description);
    $this->db->where('id', $id);
    $update = $this->db->update('documentreports');
    return $update;
  }

  // TODO: DASHBOARD
  public function get_list_unfixed_report(){
    $this->db->select('documentreports.*, users.email');
    $this->db->from('documentreports');
    $this->db->where('documentreports.status', 'revised');
    $this->db->join('users', 'users.id = documentreports.userId');
    $query = $this->db->get();

    return $query->result();
  }

  public function get_list_unverified_report(){
    $this->db->select('documentreports.*, users.email');
    $this->db->from('documentreports');
    $this->db->where('documentreports.status', 'submitted');
    $this->db->join('users', 'users.id = documentreports.userId');
    $query = $this->db->get();

    return $query->result();
  }



  public function get_list_unapproved_report(){
    $this->db->select('documentreports.*, users.email');
    $this->db->from('documentreports');
    $this->db->where('documentreports.status', 'verified');
    $this->db->or_where('documentreports.status', 'need next approval');
    $this->db->join('users', 'users.id = documentreports.userId');
    $query = $this->db->get();

    return $query->result();
  }

}
?>
