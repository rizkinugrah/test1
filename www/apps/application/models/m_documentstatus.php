<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_documentstatus extends CI_Model{

  public function __construct() {
    parent::__construct();
  }

  // TODO: POST DATA
  public function post_data($data){
    unset($data['submit']);
    $insert = $this->db->insert('documentstatus', $data);
    return $insert;
  }

  public function get_list_by_documentreportid($documentReportId){
    $this->db->select('documentstatus.*, users.email');
    $this->db->from('documentstatus');
    $this->db->join('users', 'users.id = documentstatus.userId');
    $this->db->where('documentReportId', $documentReportId);
    $query = $this->db->get();

    return $query->result();
  }

  public function get_data_by_document_status($documentReportId, $status){
    $this->db->select('*');
    $this->db->where('documentReportId', $documentReportId);
    $this->db->where('status', $status);
    $this->db->order_by("id", "desc");
    $this->db->limit(1);
    $query = $this->db->get('documentstatus');

    // $this->db->from('documentstatus');
    // $this->db->where('id', $id);
    // $query = $this->db->get();

    return $query->row();
  }



  // // TODO: GET ALL DOCUMENT REPORTS ITEM
  // public function get_list(){
  //   // SELECT *, MIN(sequence) FROM `documentstatus`
  //   // WHERE status IS NULL OR status = 'revised'
  //   // GROUP BY documentReportId
  //
  //   $this->db->select('documentstatus.id AS documentStatusId, documentstatus.status, documentreports.*, reportUser.email AS repoterUser, accUser.email AS accUser');
  //   $this->db->from('documentstatus');
  //   $this->db->join('documentreports', 'documentreports.id = documentStatus.documentReportId');
  //   $this->db->join('users AS reportUser', 'reportUser.id = documentreports.userId');
  //   $this->db->join('users AS accUser', 'accUser.id = documentstatus.userId');
  //   $this->db->where('documentstatus.status IS NULL', NULL, TRUE);
  //   $this->db->or_where('documentstatus.status', 'revised');
  //   $this->db->group_by("documentstatus.documentReportId");
  //   $query = $this->db->get();
  //
  //   return $query->result();
  // }
  //
  // // TODO: GET ALL DOCUMENT REPORTS ITEM BY REPORT ID
  // public function get_list_by_documentreportid($documentReportId){
  //   $this->db->select('*');
  //   $this->db->from('documentstatus');
  //   $this->db->where('documentReportId', $documentReportId);
  //   $query = $this->db->get();
  //
  //   return $query->result();
  // }
  //
  // // TODO: GET SINGLE ROW BY ID
  // public function get_detail($id){
  //   $this->db->select('*');
  //   $this->db->from('documentstatus');
  //   $this->db->where('id', $id);
  //   $query = $this->db->get();
  //
  //   return $query->row();
  // }
  //
  // public function is_valid_num($username){
  //   $this->db->select('*');
  //   $this->db->from('users');
  //   $this->db->where('username',$username);
  //   $query = $this->db->get();
  //
  //   return $query->num_rows();
  // }
  //
  // public function mark_as_approved_document_report($id){
  //   $this->db->set('status', 'approved');
  //   $this->db->set('approvalTimestamp', date("Y-m-d H:i:s"));
  //   $this->db->where('id', $id);
  //   $update = $this->db->update('documentstatus');
  //   return $update;
  // }
  //
  // public function mark_as_rejected_document_report($id){
  //   $this->db->set('status', 'rejected');
  //   $this->db->set('approvalTimestamp', date("Y-m-d H:i:s"));
  //   $this->db->where('id', $id);
  //   $update = $this->db->update('documentstatus');
  //   return $update;
  // }
  //
  // public function mark_as_revised_document_report($id, $description){
  //   $this->db->set('status', 'revised');
  //   $this->db->set('description', $description);
  //   $this->db->set('approvalTimestamp', date("Y-m-d H:i:s"));
  //   $this->db->where('id', $id);
  //   $update = $this->db->update('documentstatus');
  //   return $update;
  // }

}
?>
