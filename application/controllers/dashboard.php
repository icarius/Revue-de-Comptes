<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    function __construct() {
        parent::__construct();

        // Load member model
        $this->load->model('Rh_models', 'models');
        $this->load->library('Csvimport');
		$this->load->library('Github_updater');
        $this->output->enable_profiler(FALSE);
    }
    
    public function index(){
		$data['breadcrumb'] = "";
        $data['_view'] = 'welcome_message';
        $this->load->view('layouts/main2',$data);
	}	