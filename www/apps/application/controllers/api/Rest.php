<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '../vendor/autoload.php';
require APPPATH . '/libraries/REST_Controller.php';
use \Firebase\JWT\JWT;

class Rest extends REST_Controller {
  private $secretkey = 'ijgd$hbampu8jhov&degx!neph&#ew1k4@owwlf@cbma5^g-k7'; //ubah dengan kode rahasia apapun

  public function __construct(){
    parent::__construct();
    $this->load->model('m_user');
  }

  // POST : Get Token from logging in
  public function authToken_post(){
    $date = new DateTime();
    $username = $this->post('username',TRUE);
    $pass = $this->post('password',TRUE);
    $dataadmin = $this->m_user->is_valid($username);

    if ($dataadmin){

      if (md5($this->post('password')) == $dataadmin->password) {
        $payload['id'] = $dataadmin->id;
        $payload['username'] = $dataadmin->username;
        $payload['iat'] = $date->getTimestamp(); //waktu di buat
        $payload['exp'] = $date->getTimestamp() + 3600; //satu jam
        $output['token'] = JWT::encode($payload,$this->secretkey);

        $data_session = array(
          'username' => $dataadmin->username,
          'userId' => $dataadmin->id,
          'email' => $dataadmin->email,
          'isSuperAdmin' => $dataadmin->isSuperAdmin,
          'loggedIn' => true
        );

        $this->session->set_userdata($data_session);

        return $this->response($output,REST_Controller::HTTP_OK);
      } else {
        $this->failedToken($username);
      }
    } else {
      $this->failedToken($username);
    }
  }

  // Failed Token
  public function failedToken($username){
    $response = array(
      'status'=>'0',
      'username'=>$username,
      'message'=>'Invalid Username Or Password'
    );
    // $this->load->view('pages/login');
    // $this->form_validation->set_message('check_database', 'Invalid username or password');
    // return FALSE;

    // echo json_encode($response);

    $this->response([
    'status'=>'0',
    'username'=>$username,
    'message'=>'Invalid Username Or Password'
    ],REST_Controller::HTTP_BAD_REQUEST);
  }

  // Check Token
  public function checkToken(){
    $jwt = $this->input->get_request_header('Authorization');
    try {
      $decode = JWT::decode($jwt,$this->secretkey,array('HS256'));

      if ($this->m_usert->is_valid_num($decode->username)>0) {
        return true;
      }
    } catch (Exception $e) {

      $this->session->sess_destroy();

      $this->response([
      'errors'=>'Invalid token access'
      ],REST_Controller::HTTP_BAD_REQUEST);
    }
  }

}
?>
