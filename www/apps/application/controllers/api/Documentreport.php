<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/api/Rest.php';
class Documentreport extends Rest {

  function __construct($config = 'rest') {
    parent::__construct($config);
    $this->checkToken();
    $this->load->model('m_documentreport');
  }

  // TODO: GET METHOD
  function index_get($id = '') {
    if ($id == '') {
      $data = $this->m_documentreport->get_list();
    } else {
      $data = $this->m_documentreport->get_detail($id);
    }
    $this->response(array("data" => $data,'status'=>'success',), 200);
  }

  function index_post(){



    $insert = $this->m_documentreport->post_data($this->post());
    if($insert){
      $response = array(
        'data' => $this->post(),
        'status' => 'success'
      );

      $this->response($response, 200);
    } else {
      $this->response(array('status' => 'fail', 502));
    }
  }

  // function index_post($table = '') { // baseurl/?table=nama_table
  //   $insert = $this->db->insert($table, $this->post());
  //   $id = $this->db->insert_id();
  //   if ($insert) {
  //     $response = array(
  //       'data' => $this->post(),
  //       'table' => $table,
  //       'id' => $id,
  //       'status' => 'success'
  //     );
  //     $this->response($response, 200);
  //   } else {
  //     $this->response(array('status' => 'fail', 502));
  //   }
  // }
  //
  // function index_put($table = '', $id = '') { // baseurl/nama_table/id
  //   $get_id = 'id_'.$table;
  //   $this->db->where($get_id, $id);
  //   $update = $this->db->update($table, $this->put());
  //   if ($update) {
  //     $response = array(
  //       'data' => $this->put(),
  //       'table' => $table,
  //       'id' => $id,
  //       'status' => 'success'
  //     );
  //     $this->response($response, 200);
  //   } else {
  //     $this->response(array('status' => 'fail', 502));
  //   }
  // }
  //
  // function index_delete($table = '', $id = '') {
  //   $get_id = 'id_'.$table;
  //   $this->db->where($get_id, $id);
  //   $delete = $this->db->delete($table);
  //   if ($delete) {
  //     $response = array(
  //       'table' => $table,
  //       'id' => $id,
  //       'status' => 'success'
  //     );
  //     $this->response($response, 201);
  //   } else {
  //     $this->response(array('status' => 'fail', 502));
  //   }
  // }
}
?>
