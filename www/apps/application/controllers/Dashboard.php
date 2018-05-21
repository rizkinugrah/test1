<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'controllers/api/Rest.php';

class Dashboard extends MY_Controller {

	function __construct()
	{
		parent::__construct();
    $this->data['activePages'] = "Dashboard";

		$this->load->model('m_documentreport');
		$this->load->model('m_documentreportitem');
		$this->load->model('m_documentapprover');
		$this->load->model('m_documentstatus');
		$this->load->model('m_user');
	}

	function index()
	{
		$this->data['title'] = "Dashboard";

		$reports = $this->m_documentreport->get_list();
		$unfixedReport = $this->m_documentreport->get_list_unfixed_report();
		$unverifiedReport = $this->m_documentreport->get_list_unverified_report();
		$unapprovedReport = $this->m_documentreport->get_list_unapproved_report();

		$this->data['reports'] = $reports;
		$this->data['unfixedReport'] = $unfixedReport;
		$this->data['unverifiedReport'] = $unverifiedReport;
		$this->data['unapprovedReport'] = $unapprovedReport;

		$this->load->templateDefault('app/dashboard/index',$this->data);
	}
}
?>
