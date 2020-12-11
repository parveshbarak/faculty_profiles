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
                    //print_r($users); die;
                    
                    $this->load->model('Select');
                    $query = $this->Select->code_select($data['email']);
                    $query = json_decode(json_encode($query), TRUE);
                    $code = $query[0]['Code'];
                    $query['h'] = $this->Select->select3($code);
                    //$query['h'] = json_decode(json_encode($query['h']), TRUE);  
                    
                    $user_data = array(
                        'users' => $users,
                        'query' => $query
                    );
                    
                    $this->google_login_model->Update_user_data($user_data, $data['id']);
                    $this->session->set_userdata('user_data', $user_data);
                    
                } else {
//                    Case-1 : insert data
                    
//                    $user_data = array(
//                        'password' => $data['id'],
//                        'name' => $data['given_name'],
//                        'email' => $data['email'],
//                    );
//                    $this->google_login_model->Insert_user_data($user_data);
//                    $this->session->set_userdata('user_data', $user_data);

                    
//                    Case-2 : Do not insert data 
//                    show a message that you are  not a autheniticated user!
                    $this->session->unset_userdata('access_token');
                    $this->session->unset_userdata('user_data');
                    redirect('index.php');
                    echo 'You are not allowed to login!!!';  // A alert message here!!
                    
                }
            }
        }
        
        $this->load->model('Select');
        $query1['h'] = $this->Select->select2();
        
        $login_button = '';
        if (!$this->session->userdata('access_token')) {
            $login_button = '<a href="' . $google_client->createAuthUrl() . '">Login With Google</a>';
            $data['login_button'] = $login_button;
            $basic = array_merge($data, $query1);
            $this->load->view('google_login1', $basic);
        } else {
            $q = $this->session->userdata;
            $query2['h'] = $this->session->userdata['user_data']['query']['h'];
            $this->load->view('google_login1', $query2);
        }
    }

    function logout() {
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('user_data');
        redirect('index.php/google_login/login');
    }

}

?>
