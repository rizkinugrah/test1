<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'controllers/api/Rest.php';

class ReportApproval extends MY_Controller {

	function __construct()
	{
		parent::__construct();
    $this->data['activePages'] = "Report Approval";
		$this->load->model('m_documentreport');
		$this->load->model('m_documentreportitem');
		$this->load->model('m_documentapprover');
		$this->load->model('m_documentstatus');
		$this->load->model('m_user');
	}

	function index(){

		$permissionsRequired = ['view_all_reportapprover'];
		$this->checkPermissions($permissionsRequired);

		$this->data['title'] = "Report Approval";
		$this->data['reports'] = $this->m_documentreport->get_list_need_to_approval();
		$this->load->templateDefault('app/reportapproval/index',$this->data);
	}

	function detail($documentReportId = null, $documentApproverId = null){

		$permissionsRequired = ['view_all_reportapprover','view_related_reportapprover'];
		$this->checkPermissions($permissionsRequired);

		if ($documentReportId === null || $documentApproverId === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($documentReportId);

		if (!$report){
			show_404();
		}

		$reportItems = $this->m_documentreportitem->get_list_by_documentreportid($documentReportId);
		$documentApprover = $this->m_documentapprover->get_list_by_documentreportid($documentReportId);
		$this->data['title'] = "Report Detail";

		$this->data['reports'] = $report;
		$this->data['reportItems'] = $reportItems;
		$this->data['documentApprover'] = $documentApprover;
		$this->data['documentApproverId'] = $documentApproverId;

		$this->load->templateDefault('app/reportapproval/detail',$this->data);
	}

	function markAsApproved($documentReportId = null, $documentApproverId = null){

		$permissionsRequired = ['approved_report'];
		$this->checkPermissions($permissionsRequired);

		if ($documentReportId === null || $documentApproverId === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($documentReportId);

		if (!$report){
			show_404();
		}

		$this->data['title'] = "Mark as Approved Report";
		$this->data['formTitle'] = "Are you sure want to mark this report as approved ?";

		if ($report->status != 'verified' && $report->status != 'need next approval'){
			$this->session->set_flashdata('error','You cannot mark this report as verified. Please check again.');
			redirect(base_url('reportapproval/detail/'.$documentReportId.'/'.$documentApproverId));
		}

		$fields = array();
		$this->data['forms'] = $fields;

		if($this->input->post('submit') === null){
			$this->data['formsView'] = $this->load->view('templates/form.php', $this->data, TRUE);
			$this->load->templateDefault('app/reportapproval/form',$this->data);
		} else {

			$postData['documentReportId'] = $documentReportId;
			$postData['userId'] = $this->session->userdata("userId");
			$postData['status'] = 'approved';
			$postData['approvalTimestamp'] = date("Y-m-d H:i:s");
			$insert = $this->m_documentstatus->post_data($postData);

			$update = $this->m_documentapprover->update_document_approver($documentApproverId, $documentReportId, 'approved');
			if ($update && $insert){
				$this->session->set_flashdata('success','Report has been successfully mark as Approved.');
				redirect(base_url('reportapproval'));
			} else {
				echo "Integrity error";
			}
		}
	}

	function markAsRevised($documentReportId = null, $documentApproverId = null){

		$permissionsRequired = ['revised_report'];
		$this->checkPermissions($permissionsRequired);

		if ($documentReportId === null || $documentApproverId === null){
			show_404();
		}

		$report = $this->m_documentreport->get_detail($documentReportId);

		if (!$report){
			show_404();
		}

		$this->load->library('form_validation');
		$this->data['title'] = "Mark as Revised Report";
		$this->data['formTitle'] = "Are you sure want to mark this report as revised ? Please fill the description (reason) why you mark this as revised.";

		if ($report->status != 'verified' && $report->status != 'need next approval'){
			$this->session->set_flashdata('error','You cannot mark this report as verified. Please check again.');
			redirect(base_url('reportapproval/detail/'.$documentReportId.'/'.$documentApproverId));
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
      $this->load->templateDefault('app/reportapproval/form',$this->data);

    } else {
			$postData = $this->input->post();

			$postData['documentReportId'] = $documentReportId;
			$postData['userId'] = $this->session->userdata("userId");
			$postData['status'] = 'revised';
			$postData['approvalTimestamp'] = date("Y-m-d H:i:s");
			$insert = $this->m_documentstatus->post_data($postData);

			$update = $this->m_documentreport->update_document_report($documentReportId, 'revised');

			// $update = $this->m_documentapprover->update_document_approver($documentApproverId, $documentReportId, 'revised');
			if ($update){
				$this->session->set_flashdata('success','Report has been successfully mark as Revised.');
				redirect(base_url('reportapproval'));
			} else {
				echo "Integrity error";
			}
    }
	}
}
?>
