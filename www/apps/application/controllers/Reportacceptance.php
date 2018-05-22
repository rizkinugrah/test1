<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'controllers/api/Rest.php';

class ReportAcceptance extends MY_Controller {

	function __construct()
	{
		parent::__construct();
    $this->data['activePages'] = "Report Acceptance";
		$this->load->model('m_documentreport');
	}

	function index(){
		$this->data['title'] = "Report Acceptance";
		$this->data['reports'] = $this->m_documentreport->get_list();
		$this->load->templateDefault('app/report/index',$this->data);
	}
}
?>
