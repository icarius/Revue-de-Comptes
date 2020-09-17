<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ad extends CI_Controller {
    
    function __construct() {
        parent::__construct();

        // Load member model
        $this->load->model('Rh_models', 'models');
        $this->load->library('Csvimport');
        $this->output->enable_profiler(FALSE);
    }
    
    public function index(){
        $data = array();
        
        // Get messages from the session
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
		if($this->session->userdata('absents')){
            $data['absents'] = $this->session->userdata('absents');
            $this->session->unset_userdata('absents');
        }
		if($this->session->userdata('lastLogon')){
            $data['lastLogon'] = $this->session->userdata('lastLogon');
            $this->session->unset_userdata('lastLogon');
        }
		if($this->session->userdata('inactiveAccount')){
            $data['inactiveAccount'] = $this->session->userdata('inactiveAccount');
            $this->session->unset_userdata('inactiveAccount');
        }
        
        // Get rows
        $data['members'] = $this->models->getRowsAD();
        $array = array('returnType' => 'count');
        $data['count'] =  $this->models->getRowsAD($array);
        
        // Load the list page view
        //$this->load->view('rh/index', $data);

        $data['breadcrumb'] = "Compte AD";
        $data['_view'] = 'ad/index';
        $this->load->view('layouts/main2',$data);
    }
            

    public function import()
	{
        // If import request is submitted
        if($this->input->post('importSubmit')){
            // Form field validation rules
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            
            // Validate submitted form data
            if($this->form_validation->run() == true){
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                $column_headers = array('employeeID','samaccountname','givenname','sn','employeeNumber','distinguishedName','lastLogon','pwdLastSet','AccountDisabled');
                $file_data = $this->csvimport->get_array($_FILES["file"]["tmp_name"], $column_headers);
                foreach($file_data as $row)
                {
                    $rowCount++;
                    $memData[] = array(
                        'employeeID'	=>	$row["employeeID"],
                        'samaccountname'	=>	$row["samaccountname"],
                        'givenname'	=>	utf8_encode(Ucfirst($row["givenname"])),
                        'sn'	=>	utf8_encode(strtoupper($row["sn"])),
                        'employeeNumber'	=>	$row["employeeNumber"],
						'distinguishedName'	=>	$row["distinguishedName"],
						'lastLogon'	=>	$row["lastLogon"],
						'pwdLastSet'	=>	$row["pwdLastSet"],
						'AccountDisabled'	=>	$row["AccountDisabled"]
                    );
                }
                //$this->Csv_import_model->insertAD($data);
                $this->models->insertAD($memData);
                // Status message with imported data count
                $successMsg = 'Importation terminée. Total ligne ('.$rowCount.')';
                $this->session->set_userdata('success_msg', $successMsg);
            }else{
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('ad');    
	}
    
    /*
     * Callback function to check file value and type during validation
     */
    public function file_check($str){
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }
    
}