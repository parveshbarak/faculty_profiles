<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
        
        public function index()
	{
		//load the database  
		$this->load->database();
		//load the model  
		$this->load->model('Profile');
		//load the method of model  
		$data['h'] = $this->Profile->dummy();
                //print_r($data); die;
		$this->load->view('home', $data);
	}
        
}
