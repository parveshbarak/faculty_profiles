<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Google_login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('google_login_model');
    }

    function login() {
        include_once APPPATH . "libraries/vendor/autoload.php";

        $google_client = new Google_Client();

        $google_client->setClientId('751169053910-382q6g08q97525vt4qp4qmchn8uutrgn.apps.googleusercontent.com'); //Define your ClientID

        $google_client->setClientSecret('oIvz-ebQoZi71e2owuTwWnr0'); //Define your Client Secret Key

        $google_client->setRedirectUri('http://localhost/faculty_profiles/index.php/google_login/login'); //Define your Redirect Uri

        $google_client->addScope('email');

        $google_client->addScope('profile');

        if (isset($_GET["code"])) {
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

            if (!isset($token["error"])) {
                $google_client->setAccessToken($token['access_token']);

                $this->session->set_userdata('access_token', $token['access_token']);

                $google_service = new Google_Service_Oauth2($google_client);

                $data = $google_service->userinfo->get();

                if ($this->google_login_model->Is_already_register($data['id'])) {
                    //update data
                    $users= array(
                        'name' => $data['given_name'],
                        'email' => $data['email'],
                        'password' => $data['id']
                    );
                    
                    $this->load->model('Select');
                    $query = $this->Select->code_select($data['email']);
                    $query = json_decode(json_encode($query), TRUE);
                    $code = $query[0];  
                    
                    $user_data = array(
                        'users' => $users,
                        'code' => $code
                    );
                    
                    $this->google_login_model->Update_user_data($user_data, $data['id']);
                    $this->session->set_userdata('user_data', $user_data);
                    
                    
                } else {
//                    Case-1 : insert data
//                  
                    $code = 'GKV/065';
                    
                    $user_data = array(
                        'name' => $data['given_name'],
                        'email' => $data['email'],
                        'password' => $data['id'],
                        'code' => $code
                    );
//                    
                    $this->google_login_model->Insert_user_data($user_data, $data['id']);
                    //print_r($data['id']); die;
                    $this->session->set_userdata('user_data', $user_data);

                    
//                    Case-2 : Do not insert data 
//                    show a message that you are  not a autheniticated user!
                    $this->session->unset_userdata('access_token');
                    $this->session->unset_userdata('user_data');
                    redirect('index.php');
                    echo 'You are not allowed to login!!!';  // A alert message here!!
                    
                }
            }
        }
        
        // Duumy Profile
        $this->load->model('Select');
        $query1['h'] = $this->Select->select2();
        
        //Actual Profile of logged in User
        $this->load->model('Select');
        //$query2['h'] = $this->Select->select3($this->session->userdata['user_data']['code']['Code']);
        
        $login_button = '';
        if (!$this->session->userdata('access_token')) {
            $login_button = '<a href="' . $google_client->createAuthUrl() . '">Login With Google</a>';
            $data['login_button'] = $login_button;
            $basic = array_merge($data, $query1);
            $this->load->view('google_login1', $basic);
        } else {
            $q = $this->session->userdata['user_data'];
            $this->load->model('Select');
            $query2['h'] = $this->Select->select3($this->session->userdata['user_data']['code']['Code']);
            $this->load->view('google_login1', $query2);
        }
    }
    
    private function login_check($session_data,$google_client) {
        
    }
    
    function all_confrences() {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Confrences');
            $data['h'] = $this->Confrences->select($code);
            //$data = json_decode(json_encode($data), TRUE);
            //print_r($data); die;
            $this->load->view('Confrences/all_confrences', $data);
        }
    }
    
    function edit_confrences() {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $uri = $_SERVER['REQUEST_URI'];
            $uri_array = explode('/',$uri);
            $conf_id = end($uri_array);
            $this->load->model('Confrences');
            $data['h'] = $this->Confrences->select4($code,$conf_id);
            $this->load->view('Confrences/edit_confrences', $data);
        }
    }
    
    function update_confrence() {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            //code krna h
        }
    }
    
    function edit_profile() {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Select');
            $form_query = $this->Select->select3($code);
            $form_query = json_decode(json_encode($form_query), TRUE);
            //print_r($form_query['2']); die;
            $this->load->view('edit_profile');
        }
    }

    function logout() {
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('user_data');
        redirect('index.php/google_login/login');
    }

}

?>
