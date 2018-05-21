<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'controllers/api/Rest.php';

class ReportVerification extends MY_Controller {

	function __construct()
	{
		parent::__construct();
    $this->data['activePages'] = "Report Verification";
		$this->load->model('m_documentreport');
		$this->load->model('m_documentreportitem');
		$this->load->model('m_documentapprover');
		$this->load->model('m_documentstatus');
		$this->load->model('m_user');
	}

	function index(){
		$permissionsRequired = ['view_all_report'];
		$this->checkPermissions($permissionsRequired);

		$this->data['title'] = "Report Verification";
		$this->data['reports'] = $this->m_documentreport->get_list_need_to_verify();
		$this->load->templateDefault('app/reportverification/index',$this->data);
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
		$this->data['title'] = "Report Detail";

		$this->data['reports'] = $report;
		$this->data['reportItems'] = $reportItems;
		$this->data['documentApprover'] = $documentApprover;

		$this->load->templateDefault('app/reportverification/detail',$this->data);
	}

	function markAsVerified($id = null){

		$permissionsRequired = ['verified_report'];
		$this->checkPermissions($permissionsRequired);

		if($id === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($id);
		if(!$report){
			show_404();
		}

		$this->data['title'] = "Mark as Verified Report";
		$this->data['formTitle'] = "Are you sure want to mark this report as verified ?";

		$fields = array();

		if ($report->status != 'submitted'){
			$this->session->set_flashdata('error','You cannot mark this report as verified. Please check again.');
			redirect(base_url('reportverification/detail/'.$id));
		}

		$this->data['forms'] = $fields;

		if($this->input->post('submit') === null){
			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
			$this->load->templateDefault('app/reportverification/form',$this->data);
		} else {

			$postData['documentReportId'] = $id;
			$postData['userId'] = $this->session->userdata("userId");
			$postData['status'] = 'verified';
			$postData['approvalTimestamp'] = date("Y-m-d H:i:s");
			$insert = $this->m_documentstatus->post_data($postData);

			$update = $this->m_documentreport->update_document_report($id, 'verified');
			if ($update && $insert){
				$this->session->set_flashdata('success','Report has been successfully mark as Verified.');
				redirect(base_url('reportverification'));
			} else {
				echo "Integrity error";
			}
		}
	}

	function markAsRevised($id = null){

		$permissionsRequired = ['revised_report'];
		$this->checkPermissions($permissionsRequired);

		if($id === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($id);
		if(!$report){
			show_404();
		}

		$this->load->library('form_validation');
		$this->data['title'] = "Mark as Revised Report";
		$this->data['formTitle'] = "Are you sure want to mark this report as revised ? Please fill the description (reason) why you mark this as revised.";

		if ($report->status != 'submitted'){
			$this->session->set_flashdata('error','You cannot mark this report as verified. Please check again.');
			redirect(base_url('reportverification/detail/'.$id));
		}

		$fields = array(
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
			$postData['userId'] = $this->session->userdata("userId");
			$postData['status'] = 'revised';
			$postData['approvalTimestamp'] = date("Y-m-d H:i:s");
			$insert = $this->m_documentstatus->post_data($postData);

			$update = $this->m_documentreport->update_document_report($id, 'revised');
			if ($update && $insert){
				$this->session->set_flashdata('success','Report has been successfully mark as Revised.');
				redirect(base_url('reportverification'));
			} else {
				echo "Integrity error";
			}
    }
	}
}
?>
