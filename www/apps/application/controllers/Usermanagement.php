<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'controllers/api/Rest.php';

class UserManagement extends MY_Controller {

	function __construct()
	{
		parent::__construct();
    $this->data['activePages'] = "User Management";
		$this->load->model('m_user');
		$this->load->model('m_group');
		$this->load->model('m_profile');
		$this->load->model('m_permission');
	}

  function index(){

		$permissionsRequired = ['view_all_user'];
		$this->checkPermissions($permissionsRequired);

		$this->data['title'] = "User Management";
		$this->data['users'] = $this->m_user->get_list();
		$this->load->templateDefault('app/usermanagement/index',$this->data);
	}

	function add(){
		$permissionsRequired = ['add_user'];
		$this->checkPermissions($permissionsRequired);

		$this->load->library('form_validation');
		$this->data['title'] = "User Add";

		$groupList = $this->m_group->get_list_group();
		$groupOptions = array();
		foreach ($groupList as $value) {
			$items = array();
			$items['value'] = $value->id;
			$items['label'] = ucwords(str_replace("_"," ",$value->name));

			array_push($groupOptions,$items);
		}

		$fields = array(
			array(
				'name' => 'name',
				'type' => 'text',

				'field' => 'name',
				'label' => 'Full Name',
				'rules' => 'required|min_length[5]'
			),
			array(
				'name' => 'department',
				'type' => 'text',

				'field' => 'department',
				'label' => 'Department',
				'rules' => 'required'
			),
			array(
				'name' => 'divisi',
				'type' => 'text',

				'field' => 'divisi',
				'label' => 'Divisi',
				'rules' => 'required'
			),
			array(
				'name' => 'groupId',
				'type' => 'select',

				'field' => 'groupId',
				'label' => 'Group',
				'options' => $groupOptions,
				'rules' => 'required'
			),
			array(
				'name' => 'address',
				'type' => 'text',

				'field' => 'address',
				'label' => 'Address'
			),
			array(
				'name' => 'mobilePhone',
				'type' => 'number',

				'field' => 'mobilePhone',
				'label' => 'Phone Number',
				'rules' => 'required'
			),
			array(
				'name' => 'username',
				'type' => 'text',

				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|min_length[5]|callback_username_check'
			),
			array(
				'name' => 'email',
				'type' => 'text',

				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email|callback_email_check'
			),
			array(
				'name' => 'password',
				'type' => 'password',
				'formNote' => 'Set default and give it to user. And application will ask user to change it when first loggin.',

				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|min_length[5]'
			),
			array(
				'name' => 'passwordConfirmation',
				'type' => 'password',

				'field' => 'passwordConfirmation',
				'label' => 'Password Confirmation',
				'rules' => 'required|matches[password]'
			)
		);

		$this->data['forms'] = $fields;
		$this->form_validation->set_rules($fields);

		if ($this->form_validation->run() == FALSE) {
			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
      $this->load->templateDefault('app/usermanagement/form',$this->data);
    } else {
			$postData = $this->input->post();

			$dataUser['groupId'] = $postData['groupId'];
			$dataUser['username'] = $postData['username'];
			$dataUser['email'] = $postData['email'];
			$dataUser['password'] = md5($postData['password']);

			$insertUser = $this->m_user->post_data($dataUser);
			$userId = $this->db->insert_id();

			$dataProfile['userId'] = $userId;
			$dataProfile['name'] = $postData['name'];
			$dataProfile['address'] = $postData['address'];
			$dataProfile['mobilePhone'] = $postData['mobilePhone'];
			$dataProfile['department'] = $postData['department'];
			$dataProfile['divisi'] = $postData['divisi'];

			$insertProfile = $this->m_profile->post_data($dataProfile);

			if ($insertUser && $insertProfile){
				$this->session->set_flashdata('success','User has been successfully created.');
				redirect(base_url('usermanagement'));
			} else {
				echo "Integrity error";
			}
    }
	}

	public function username_check($username)
	{
		$data = $this->m_user->is_unique_username($username);

		if ($data) {
			$this->form_validation->set_message('username_check', 'Username: "'.$username.'" has been taken please use another username.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function email_check($email)
	{
		$data = $this->m_user->is_unique_email($email);
		if ($data) {
			$this->form_validation->set_message('email_check', 'Email: "'.$email.'" has been taken please use another email.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	// ============================================================================================================= GROUP
	function group(){
		$this->data['title'] = "Groups";
		$this->data['groups'] = $this->m_group->get_list();
		$this->load->templateDefault('app/group/index',$this->data);
	}

	function detailGroup($id){
		$this->data['title'] = "Groups Detail";
		$this->data['groups'] = $this->m_group->get_detail($id);
		$this->data['grouppermissions'] = $this->m_group->get_group_permissions_list_by_group($id);
		$this->load->templateDefault('app/group/detail',$this->data);
	}

	function addGroup(){
		$this->load->library('form_validation');
		$this->data['title'] = "Group Add";

		$fields = array(
			array(
				'name' => 'name',
				'type' => 'text',

				'field' => 'name',
				'label' => 'Group Name',
				'rules' => 'required|min_length[5]'
			)
		);

		$this->data['forms'] = $fields;
		$this->form_validation->set_rules($fields);

		if ($this->form_validation->run() == FALSE) {
			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
      $this->load->templateDefault('app/group/form',$this->data);
    } else {
			$postData = $this->input->post();

			$postData['name'] = strtolower(str_replace(" ","_",$postData['name']));

			$insert = $this->m_group->post_data($postData);

			if ($insert){
				$this->session->set_flashdata('success','Group has been successfully created.');
				redirect(base_url('usermanagement/group'));
			} else {
				echo "Integrity error";
			}
    }
	}

	function editGroup($id){
		$this->load->library('form_validation');
		$this->data['title'] = "Group Edit";

		$groups = $this->m_group->get_detail($id);

		$fields = array(
			array(
				'name' => 'name',
				'type' => 'text',
				'value' => ucwords(str_replace("_"," ",$groups->name)),

				'field' => 'name',
				'label' => 'Group Name',
				'rules' => 'required|min_length[5]'
			)
		);

		$this->data['forms'] = $fields;
		$this->form_validation->set_rules($fields);

		if ($this->form_validation->run() == FALSE) {
			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
      $this->load->templateDefault('app/group/form',$this->data);
    } else {
			$postData = $this->input->post();

			$postData['name'] = strtolower(str_replace(" ","_",$postData['name']));

			$insert = $this->m_group->put_data($id, $postData);

			if ($insert){
				$this->session->set_flashdata('success','Group has been successfully edited.');
				redirect(base_url('usermanagement/group'));
			} else {
				echo "Integrity error";
			}
    }
	}

	function addPermissions($id){
		$this->load->library('form_validation');
		$this->data['title'] = "Permissions Add";

		$permissionsList = $this->m_permission->get_list($id);
		$permissionOptions = array();
		foreach ($permissionsList as $value) {
			$items = array();
			$items['value'] = $value->id;
			$items['label'] = ucwords(str_replace("_"," ",$value->name)).' | '.$value->description;

			array_push($permissionOptions,$items);
		}

		$fields = array(
			array(
				'name' => 'permissionId',
				'type' => 'select',
				'options' => $permissionOptions,

				'field' => 'permissionId',
				'label' => 'Permissions',
				'rules' => 'required'
			)
		);

		$this->data['forms'] = $fields;
		$this->form_validation->set_rules($fields);

		if ($this->form_validation->run() == FALSE) {
			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
      $this->load->templateDefault('app/group/form',$this->data);
    } else {
			$postData = $this->input->post();

			$postData['groupId'] = $id;

			$insert = $this->m_group->post_grouppermissions($postData);

			if ($insert){
				$this->session->set_flashdata('success','Permissions has been successfully created.');
				redirect(base_url('usermanagement/detailGroup/'.$id));
			} else {
				echo "Integrity error";
			}
    }
	}

	function removePermissions($id){
		$this->data['title'] = "Remove Permissions";
		$this->data['formTitle'] = "Are you sure want to remove this permissions ?";

		$fields = array();

		$this->data['forms'] = $fields;

		if($this->input->post('submit') === null){
			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
			$this->load->templateDefault('app/group/form',$this->data);
		} else {

			$delete = $this->m_group->delete_grouppermissions($id);
			if ($delete){
				$this->session->set_flashdata('success','Permisions has been successfully deleted.');
				redirect(base_url('usermanagement/group/'));
			} else {
				echo "Integrity error";
			}
		}
	}
}
?>
