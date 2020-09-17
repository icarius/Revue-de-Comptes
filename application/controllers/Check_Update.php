<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check_Update extends CI_Controller {

    function __construct() {
        parent::__construct();

        // Load member model
		$this->load->library('Github_updater');
        //$this->output->enable_profiler(FALSE);
    }
    
    public function index(){
		$data['breadcrumb'] = "Check Mise à jour";
        $data['_view'] = 'welcome_message';
		$data['git_update'] =  $this->github_updater->has_update();

        $this->load->view('layouts/main2',$data);
	}	

}
	