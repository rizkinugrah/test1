<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'controllers/api/Rest.php';

class Report extends MY_Controller {

	function __construct()
	{
		parent::__construct();
    $this->data['activePages'] = "Report";
		$this->load->model('m_documentreport');
		$this->load->model('m_documentreportitem');
		$this->load->model('m_documentapprover');
		$this->load->model('m_documentstatus');
		$this->load->model('m_user');
	}

	function index(){
		$permissionsRequired = ['view_all_report','view_related_report'];
		$this->checkPermissions($permissionsRequired);

		$this->data['title'] = "Report";
		$this->data['reports'] = $this->m_documentreport->get_list();
		$this->load->templateDefault('app/report/index',$this->data);
	}

	function detail($id = null){
		$permissionsRequired = ['view_all_report','view_related_report'];
		$this->checkPermissions($permissionsRequired);

		if($id === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($id);
		if(!$report){
			show_404();
		}

		$reportItems = $this->m_documentreportitem->get_list_by_documentreportid($id);
		$documentApprover = $this->m_documentapprover->get_list_by_documentreportid($id);
		$documentStatus = $this->m_documentstatus->get_list_by_documentreportid($id);
		$documentRevised = $this->m_documentstatus->get_data_by_document_status($id, $report->status);

		$this->data['title'] = "Report Detail";

		$this->data['reports'] = $report;
		$this->data['reportItems'] = $reportItems;
		$this->data['documentApprover'] = $documentApprover;
		$this->data['documentRevised'] = $documentRevised;
		$this->data['documentStatus'] = $documentStatus;

		if (sizeof($reportItems) == 0 || sizeof($documentApprover) == 0){
			$this->session->set_flashdata('warning','Report Items or Approver not create yet. Please add before submit this report.');
		}

		$this->load->templateDefault('app/report/detail',$this->data);

	}

	function add(){
		$permissionsRequired = ['add_report'];
		$this->checkPermissions($permissionsRequired);

		$this->load->library('form_validation');
		$this->data['title'] = "Report Add";

		$fields = array(
			array(
				'name' => 'type',
				'type' => 'text',

				'field' => 'type',
				'label' => 'Type',
				'rules' => 'required|min_length[5]'
			),
			array(
				'name' => 'value',
				'type' => 'number',

				'field' => 'value',
				'label' => 'Value',
				'rules' => 'required|numeric'
			),
			array(
				'name' => 'activityTimestamp',
				'type' => 'date',
				'label' => 'Activity Date'
			),
			array(
				'name' => 'description',
				'type' => 'textarea',
			)
		);

		$this->data['forms'] = $fields;
		$this->form_validation->set_rules($fields);

		if ($this->form_validation->run() == FALSE) {
			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
      $this->load->templateDefault('app/report/form',$this->data);
    } else {
			$postData = $this->input->post();

			if(strtotime($postData['activityTimestamp']) >= strtotime(date('d-m-Y'))) {
				$this->session->set_flashdata('error',sprintf('You have submitted for invalid Activity Date (%s). Please check again.',$postData['activityTimestamp']));
				redirect($this->uri->uri_string());
			} else {
				$postData['userId'] = $this->session->userdata("userId");
				$insert = $this->m_documentreport->post_data($postData);
				if ($insert){
					$this->session->set_flashdata('success','Report has been successfully created.');
					redirect(base_url('report/detail/'.$this->db->insert_id()));
				} else {
					echo "Integrity error";
				}
			}
    }
	}

	function edit($id = null){
		$permissionsRequired = ['change_all_report','change_related_report'];
		$this->checkPermissions($permissionsRequired);

		if($id === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($id);
		if(!$report){
			show_404();
		}

		$this->load->library('form_validation');
		$this->data['title'] = "Report Edit";

		// if($reports->status != null && $reports->status != 'revised')
		if ($report->status == 'submitted' || $report->status == 'verified' || $report->status == 'need next approval' || $report->status == 'approved'){
			$this->session->set_flashdata('error','You cannto edit this report. Please check again.');
			redirect(base_url('report/detail/'.$id));
		}

		$fields = array(
			array(
				'name' => 'type',
				'type' => 'text',
				'value' => $report->type,

				'field' => 'type',
				'label' => 'Type',
				'rules' => 'required|min_length[5]'
			),
			array(
				'name' => 'value',
				'type' => 'number',
				'value' => $report->value,

				'field' => 'value',
				'label' => 'Value',
				'rules' => 'required|numeric'
			),
			array(
				'name' => 'activityTimestamp',
				'type' => 'date',
				'label' => 'Activity Date',
				'value' => $report->activityTimestamp
			),
			array(
				'name' => 'description',
				'type' => 'textarea',
				'value' => $report->description
			)
		);

		$this->data['forms'] = $fields;
		$this->form_validation->set_rules($fields);

		if ($this->form_validation->run() == FALSE) {

			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
      $this->load->templateDefault('app/report/form',$this->data);

    } else {
			$postData = $this->input->post();
			$postData['userId'] = $this->session->userdata("userId");
			$update = $this->m_documentreport->put_data($id, $postData);
			if ($update){
				$this->session->set_flashdata('success','Report has been successfully updated.');
				redirect(base_url('report/detail/'.$id));
			} else {
				echo "Integrity error";
			}
    }
	}

	function delete($id = null){
		$permissionsRequired = ['change_all_report','change_related_report'];
		$this->checkPermissions($permissionsRequired);

		if($id === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($id);
		if(!$report){
			show_404();
		}

		$this->data['title'] = "Delete Report";
		$this->data['formTitle'] = "Are you sure want to delete this report?";

		if ($report->status !== NULL){
			$this->session->set_flashdata('error','You cannot delete this report.');
			redirect(base_url('report/detail/'.$id));
		}

		$fields = array();

		$this->data['forms'] = $fields;

		if($this->input->post('submit') === null){
			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
			$this->load->templateDefault('app/report/form',$this->data);
		} else {
			$delete = $this->m_documentreport->delete_data($id);
			if ($delete){
				$this->session->set_flashdata('success','Report has been successfully deleted.');
				redirect(base_url('report'));
			} else {
				echo "Integrity error";
			}
		}
	}

	// ======================================================================================================= REPORT ITEM
	function addItem($id = null){

		$permissionsRequired = ['add_reportitem'];
		$this->checkPermissions($permissionsRequired);

		if($id === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($id);
		if(!$report){
			show_404();
		}

		$this->load->library('form_validation');
		$this->data['title'] = "Report Item Add";

		if ($report->status == 'submitted' || $report->status == 'verified' || $report->status == 'need next approval' || $report->status == 'approved'){
			$this->session->set_flashdata('error','You cannot add repot item. Please check again.');
			redirect(base_url('report/detail/'.$id));
		}

		$fields = array(
			array(
				'name' => 'value',
				'type' => 'number',

				'field' => 'value',
				'label' => 'Value',
				'rules' => 'required|numeric'
			),
			array(
				'name' => 'description',
				'type' => 'textarea',

				'field' => 'description',
				'label' => 'Description',
				'rules' => 'required'
			)
		);

		$this->data['forms'] = $fields;
		$this->form_validation->set_rules($fields);

		if ($this->form_validation->run() == FALSE) {

			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
      $this->load->templateDefault('app/report/form',$this->data);

    } else {
			$postData = $this->input->post();
			$postData['documentReportId'] = $id;
			$insert = $this->m_documentreportitem->post_data($postData);
			if ($insert){
				$this->session->set_flashdata('success','Report Item has been successfully added.');
				redirect(base_url('report/detail/'.$id));
			} else {
				echo "Integrity error";
			}
    }
	}

	function editItem($documentReportId = null, $id = null){

		$permissionsRequired = ['change_all_reportitem','change_related_reportitem'];
		$this->checkPermissions($permissionsRequired);

		if($id === null || $documentReportId === null){
			show_404();
		}

		$reportItem = $this->m_documentreportitem->get_detail($id);
		$report = $this->m_documentreport->get_detail($documentReportId);

		if(!$report || !$reportItem){
			show_404();
		}

		$this->load->library('form_validation');
		$this->data['title'] = "Edit Report Item";

		if ($report->status == 'submitted' || $report->status == 'verified' || $report->status == 'need next approval' || $report->status == 'approved'){
			$this->session->set_flashdata('error','You cannot edit this report item. Please check again.');
			redirect(base_url('report/detail/'.$documentReportId));
		}

		$fields = array(
			array(
				'name' => 'value',
				'type' => 'number',
				'value' => $reportItem->value,

				'field' => 'value',
				'label' => 'Value',
				'rules' => 'required|numeric'
			),
			array(
				'name' => 'description',
				'type' => 'textarea',
				'value' => $reportItem->description,

				'field' => 'description',
				'label' => 'Description',
				'rules' => 'required'
			)
		);

		$this->data['forms'] = $fields;
		$this->form_validation->set_rules($fields);

		if ($this->form_validation->run() == FALSE) {

			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
      $this->load->templateDefault('app/report/form',$this->data);

    } else {
			$postData = $this->input->post();
			$postData['documentReportId'] = $documentReportId;
			$insert = $this->m_documentreportitem->put_data($id, $postData);
			if ($insert){
				$this->session->set_flashdata('success','Report Item has been successfully updated.');
				redirect(base_url('report/detail/'.$documentReportId));
			} else {
				echo "Integrity error";
			}
    }
	}

	function deleteItem($documentReportId = null, $id = null){

		$permissionsRequired = ['change_all_reportitem','change_related_reportitem'];
		$this->checkPermissions($permissionsRequired);

		if($id === null || $documentReportId === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($documentReportId);

		if(!$report){
			show_404();
		}

		$this->data['title'] = "Delete Report Item";
		$this->data['formTitle'] = "Are you sure want to delete this report item?";


		if ($report->status == 'submitted' || $report->status == 'verified' || $report->status == 'need next approval' || $report->status == 'approved'){
			$this->session->set_flashdata('error','You cannot delete this report item. Please check again.');
			redirect(base_url('report/detail/'.$documentReportId));
		}

		$fields = array();
		$this->data['forms'] = $fields;

		if($this->input->post('submit') === null){
			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
			$this->load->templateDefault('app/report/form',$this->data);
		} else {
			$delete = $this->m_documentreportitem->delete_data($id);
			if ($delete){
				$this->session->set_flashdata('success','Report Item has been successfully deleted.');
				redirect(base_url('report/detail/'.$documentReportId));
			} else {
				echo "Integrity error";
			}
		}
	}

	// ================================================================================================ REPORT VERIFICATOR
	function addApprover($id = null){

		$permissionsRequired = ['add_reportapprover'];
		$this->checkPermissions($permissionsRequired);

		if($id === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($id);

		if(!$report){
			show_404();
		}

		$this->load->library('form_validation');
		$this->data['title'] = "Add Report Approval";

		if ($report->status == 'submitted' || $report->status == 'verified' || $report->status == 'need next approval' || $report->status == 'approved'){
			$this->session->set_flashdata('error','You cannot add repot approver. Please check again.');
			redirect(base_url('report/detail/'.$id));
		}

		$userList = $this->m_user->get_list_kabag();
		$userOptions = array();
		foreach ($userList as $value) {
			$items = array();
			$items['value'] = $value->id;
			$items['label'] = $value->email;

			array_push($userOptions,$items);
		}

		$fields = array(
			array(
				'name' => 'userId',
				'type' => 'select',

				'field' => 'userId',
				'label' => 'Verificator',
				'options' => $userOptions,
				'rules' => 'required'
			),
			array(
				'name' => 'sequence',
				'type' => 'number',

				'field' => 'sequence',
				'label' => 'Sequence',
				'rules' => 'required|numeric'
			)
		);

		$this->data['forms'] = $fields;
		$this->form_validation->set_rules($fields);

		if ($this->form_validation->run() == FALSE) {

			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
      $this->load->templateDefault('app/report/form',$this->data);

    } else {
			$postData = $this->input->post();
			$postData['documentReportId'] = $id;
			$insert = $this->m_documentapprover->post_data($postData);
			if ($insert){
				$this->session->set_flashdata('success','Report Approver has been successfully added.');
				redirect(base_url('report/detail/'.$id));
			} else {
				echo "Integrity error";
			}
    }
	}

	function editApprover($documentReportId = null, $id = null){

		$permissionsRequired = ['change_all_reportapprover','change_related_reportapprover'];
		$this->checkPermissions($permissionsRequired);

		if($id === null || $documentReportId === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($documentReportId);

		if(!$report){
			show_404();
		}

		$this->load->library('form_validation');
		$this->data['title'] = "Edit Report Approver";

		if ($report->status == 'submitted' || $report->status == 'verified' || $report->status == 'need next approval' || $report->status == 'approved'){
			$this->session->set_flashdata('error','You cannot edit repot approver. Please check again.');
			redirect(base_url('report/detail/'.$documentReportId));
		}

		$userList = $this->m_user->get_list_kabag();
		$userOptions = array();
		foreach ($userList as $value) {
			$items = array();
			$items['value'] = $value->id;
			$items['label'] = $value->email;

			array_push($userOptions,$items);
		}

		$reportApprover = $this->m_documentapprover->get_detail($id);

		$fields = array(
			array(
				'name' => 'userId',
				'type' => 'select',
				'value' => $reportApprover->userId,

				'field' => 'userId',
				'label' => 'Verificator',
				'options' => $userOptions,
				'rules' => 'required'
			),
			array(
				'name' => 'sequence',
				'type' => 'number',
				'value' => $reportApprover->sequence,

				'field' => 'sequence',
				'label' => 'Sequence',
				'rules' => 'required|numeric'
			)
		);

		$this->data['forms'] = $fields;
		$this->form_validation->set_rules($fields);

		if ($this->form_validation->run() == FALSE) {

			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
      $this->load->templateDefault('app/report/form',$this->data);

    } else {
			$postData = $this->input->post();
			$postData['documentReportId'] = $documentReportId;
			$insert = $this->m_documentapprover->put_data($id, $postData);
			if ($insert){
				$this->session->set_flashdata('success','Report Approver has been successfully updated.');
				redirect(base_url('report/detail/'.$documentReportId));
			} else {
				echo "Integrity error";
			}
    }
	}

	function deleteApprover($documentReportId = null, $id = null){

		$permissionsRequired = ['change_all_reportapprover','change_related_reportapprover'];
		$this->checkPermissions($permissionsRequired);

		if($id === null || $documentReportId === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($documentReportId);

		if(!$report){
			show_404();
		}

		$this->data['title'] = "Delete Report Approver";
		$this->data['formTitle'] = "Are you sure want to delete this report approver?";

		if ($report->status == 'submitted' || $report->status == 'verified' || $report->status == 'need next approval' || $report->status == 'approved'){
			$this->session->set_flashdata('error','You cannot edit repot approver. Please check again.');
			redirect(base_url('report/detail/'.$documentReportId));
		}

		$fields = array();
		$this->data['forms'] = $fields;

		if($this->input->post('submit') === null){
			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
			$this->load->templateDefault('app/report/form',$this->data);
		} else {
			$delete = $this->m_documentapprover->delete_data($id);
			if ($delete){
				$this->session->set_flashdata('success','Report Approver has been successfully deleted.');
				redirect(base_url('report/detail/'.$documentReportId));
			} else {
				echo "Integrity error";
			}
		}
	}

	// ==================================================================================================== STATUS CHANGES
	function submitDocumentReport($id = null){

		$permissionsRequired = ['add_report'];
		$this->checkPermissions($permissionsRequired);

		if($id === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($id);

		if(!$report){
			show_404();
		}

		$this->data['title'] = "Submit Report";
		$this->data['formTitle'] = "Are you sure want to submit this report ?";

		$reportItems = $this->m_documentreportitem->get_list_by_documentreportid($id);
		$documentApprover = $this->m_documentapprover->get_list_by_documentreportid($id);

		if ( sizeof($reportItems) == 0 || sizeof($documentApprover) == 0 || $report->status == 'submitted' || $report->status == 'verified' || $report->status == 'need next approval' || $report->status == 'approved'){
			$this->session->set_flashdata('error','You cannot submit this report. Please check again.');
			redirect(base_url('report/detail/'.$id));
		}

		$fields = array();

		$this->data['forms'] = $fields;

		if($this->input->post('submit') === null){
			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
			$this->load->templateDefault('app/report/form',$this->data);
		} else {
			$postData['documentReportId'] = $id;
			$postData['userId'] = $this->session->userdata("userId");
			$postData['status'] = 'submitted';
			$postData['approvalTimestamp'] = date("Y-m-d H:i:s");
			$insert = $this->m_documentstatus->post_data($postData);

			$update = $this->m_documentreport->update_document_report($id, 'submitted');
			if ($update && $insert){
				$this->session->set_flashdata('success','Report has been successfully submitted.');
				redirect(base_url('report'));
			} else {
				echo "Integrity error";
			}
		}
	}
}
?>
