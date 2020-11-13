<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
            //load the url_helper for css/js
            $this->load->helper('url'); 
            //load the database  
            $this->load->database();  
            //load the model  
            $this->load->model('Select');  
            //load the method of model  
            $data['h']=$this->Select->select();  
            //return the data in view  
            $this->load->view('home_1', $data); 
	}
}
