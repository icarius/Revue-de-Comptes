<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public $flush_output = TRUE;
    function __construct() {
        parent::__construct();

        // Load member model
		$this->load->library('Github_updater');
        //$this->output->enable_profiler(FALSE);
    }
    
    public function index(){
		$data['breadcrumb'] = "";
        $data['_view'] = 'welcome_message';
		$data['git_update'] =  $this->github_updater->has_update();
		if($data['git_update']){
				$data['success'] = $this->github_updater->update();
		}	
        $this->load->view('layouts/main2',$data);
	}	
    private function _flush($message = '') {
        if($this->flush_output === TRUE) {
            echo $message.'<br/>';
            ob_flush();
            flush();
        }
    }
}
	