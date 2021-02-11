<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Google_login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('url', 'text', 'form', 'file', 'html');
        $this->load->model('google_login_model');
    }

    // Login Function

    function login()
    {
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
                    $users = array(
                        'name' => $data['given_name'],
                        'email' => $data['email'],
                        'password' => $data['id']
                    );

                    $this->load->model('Profile');
                    $query = $this->Profile->code_select($data['email']);
                    $query = json_decode(json_encode($query), TRUE);
                    $code = $query[0];

                    $user_data = array(
                        'users' => $users,
                        'code' => $code
                    );

                    $this->google_login_model->Update_user_data($user_data, $data['id']);
                    $this->session->set_userdata('user_data', $user_data);
                } else {
                    //Case-1 : insert data    
                    //We need to Make a code using His Email Id
                    $code = 'GKV/062';

                    $user_data = array(
                        'name' => $data['given_name'],
                        'email' => $data['email'],
                        'password' => $data['id'],
                        'code' => $code
                    );
                    $this->google_login_model->Insert_user_data($user_data, $data['id']);
                    $this->session->set_userdata('user_data', $user_data);


                    // Case-2 : Do not insert data 
                    // show a message that you are  not a autheniticated user!
                    $this->session->unset_userdata('access_token');
                    $this->session->unset_userdata('user_data');
                    redirect('index.php');
                    echo 'You are not allowed to login!!!';  // A alert message here!!

                }
            }
        }
        // Duumy Profile
        //In Future Replace it with Home Page of Faculties Data
        $this->load->model('Profile');
        $query1['h'] = $this->Profile->dummy();

        $login_button = '';
        if (!$this->session->userdata('access_token')) {
            $login_button = '<a href="' . $google_client->createAuthUrl() . '">Login With Google</a>';
            $data['login_button'] = $login_button;
            $basic = array_merge($data, $query1);
            $this->load->view('profile', $basic);
        } else {
            $q = $this->session->userdata['user_data'];
            $this->load->model('Profile');
            $query2['h'] = $this->Profile->profile($this->session->userdata['user_data']['code']['Code']);
            $this->load->view('profile', $query2);
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Confrences
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function all_confrences()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Confrences');
            $data['h'] = $this->Confrences->select($code);
            $this->load->view('Confrences/all_confrences', $data);
        }
    }

    function edit_confrences()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $uri = $_SERVER['REQUEST_URI'];
            $uri_array = explode('/', $uri);
            $conf_id = end($uri_array);
            $this->load->model('Confrences');
            $data['h'] = $this->Confrences->get_confrence($code, $conf_id);
            $this->load->view('Confrences/edit_confrences', $data);
        }
    }

    function new_confrence()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->view('Confrences/add_confrence');
        }
    }

    function update_confrence()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ConfType', 'Confrence Type', 'required');
            $this->form_validation->set_rules('ConfPlace', 'Confrrence Place', 'required');
            $this->form_validation->set_rules('ConfTopic', 'Confrence Topic', 'required');
            $this->form_validation->set_rules('ConfOrgBy', 'Confrence Organised By', 'required');
            $this->form_validation->set_rules('ConfDateFm', 'Confrence Date from', 'required');
            $this->form_validation->set_rules('ConfDateTo', 'Confrence Date To', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $code = $this->session->userdata['user_data']['code']['Code'];
                $form_data = $this->input->post();
                $id = $form_data['Id'];
                $this->load->model('Confrences');
                $result = $this->Confrences->update_confrence($form_data, $code, $id);
                if ($result) {
                    echo "Confrence successfully updated";
                } else {
                    echo "Something Went Wrong! ";
                }
            }
        }
    }

    function add_confrence()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ConfType', 'Confrence Type', 'required');
            $this->form_validation->set_rules('ConfPlace', 'Confrrence Place', 'required');
            $this->form_validation->set_rules('ConfTopic', 'Confrence Topic', 'required');
            $this->form_validation->set_rules('ConfOrgBy', 'Confrence Organised By', 'required');
            $this->form_validation->set_rules('ConfDateFm', 'Confrence Date from', 'required');
            $this->form_validation->set_rules('ConfDateTo', 'Confrence Date To', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $code = $this->session->userdata['user_data']['code']['Code'];
                $form_data = $this->input->post();
                $image_path = $this->upload_file_and_get_path();
                $this->load->model('Confrences');
                $count = $this->Confrences->select($code);
                $count = sizeof($count);
                $serial_no = $count + 1;
                $this->load->model('Confrences');
                $result = $this->Confrences->add_confrence($form_data, $code, $serial_no, $image_path);
                if ($result) {
                    echo "Confrence successfully Added";
                } else {
                    echo "Something Went Wrong! ";
                }
            }
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //BOOKS
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function all_books()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Books');
            $data['h'] = $this->Books->select($code);
            $this->load->view('Books/all_books', $data);
        }
    }

    function edit_books()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $uri = $_SERVER['REQUEST_URI'];
            $uri_array = explode('/', $uri);
            $book_id = end($uri_array);
            $this->load->model('Books');
            $data['h'] = $this->Books->get_book($code, $book_id);
            $this->load->view('Books/edit_books', $data);
        }
    }

    function new_book()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->view('Books/add_book');
        }
    }

    function update_book()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('BookAuthor', 'Book Type', 'required');
            $this->form_validation->set_rules('BookTitle', 'Book Place', 'required');
            $this->form_validation->set_rules('BookPublication', 'Book Topic', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $code = $this->session->userdata['user_data']['code']['Code'];
                $form_data = $this->input->post();
                $id = $form_data['Id'];
                $this->load->model('Books');
                $result = $this->Books->update_book($form_data, $code, $id);
                if ($result) {
                    echo "Book successfully updated";
                } else {
                    echo "Something Went Wrong! ";
                }
            }
        }
    }

    function add_book()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('BookAuthor', 'Book Type', 'required');
            $this->form_validation->set_rules('BookTitle', 'Book Place', 'required');
            $this->form_validation->set_rules('BookPublication', 'Book Topic', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $code = $this->session->userdata['user_data']['code']['Code'];
                $form_data = $this->input->post();
                $image_path = $this->upload_file_and_get_path();
                echo $image_path;
                die;
                $this->load->model('Books');
                $count = $this->Books->select($code);
                $count = sizeof($count);
                $serial_no = $count + 1;
                $this->load->model('Books');
                $result = $this->Books->add_book($form_data, $code, $serial_no, $image_path);
                if ($result) {
                    echo "Book successfully Added";
                } else {
                    echo "Something Went Wrong! ";
                }
            }
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Journals
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function all_journals()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Journals');
            $data['h'] = $this->Journals->select($code);
            $this->load->view('Journals/all_journals', $data);
        }
    }

    function edit_journals()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $uri = $_SERVER['REQUEST_URI'];
            $uri_array = explode('/', $uri);
            $journal_id = end($uri_array);
            $this->load->model('Journals');
            $data['h'] = $this->Journals->get_journal($code, $journal_id);
            $this->load->view('Journals/edit_journals', $data);
        }
    }

    function new_journal()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->view('Journals/add_journal');
        }
    }

    function update_journal()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('PublType', 'Journal Publication Type', 'required');
            $this->form_validation->set_rules('Authors', 'Journal Author', 'required');
            $this->form_validation->set_rules('Paper', 'Journal Paper', 'required');
            $this->form_validation->set_rules('JournalName', 'Journal Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $code = $this->session->userdata['user_data']['code']['Code'];
                $form_data = $this->input->post();
                $id = $form_data['Id'];
                $this->load->model('Journals');
                $result = $this->Journals->update_journal($form_data, $code, $id);
                if ($result) {
                    echo "Journal successfully updated";
                } else {
                    echo "Something Went Wrong! ";
                }
            }
        }
    }

    function add_journal()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect('index.php');
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('PublType', 'Journal Publication Type', 'required');
            $this->form_validation->set_rules('Authors', 'Journal Authors', 'required');
            $this->form_validation->set_rules('Paper', 'Journal Paper', 'required');
            $this->form_validation->set_rules('JournalName', 'Journal Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $code = $this->session->userdata['user_data']['code']['Code'];
                $form_data = $this->input->post();
                $image_path = $this->upload_file_and_get_path();
                echo $image_path;
                die;
                $this->load->model('Journals');
                $count = $this->Journals->select($code);
                $count = sizeof($count);
                $serial_no = $count + 1;
                $this->load->model('Journals');
                $result = $this->Journals->add_journal($form_data, $code, $serial_no, $image_path);
                if ($result) {
                    echo "Journal successfully Added";
                } else {
                    echo "Something Went Wrong! ";
                }
            }
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //UPLOAD FUNCTION
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    private function upload_file_and_get_path(): string
    {
        $this->load->library('upload');
        $image_path = "";
        $config['upload_path'] = './static/images/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if ($this->upload->do_upload('image_path')) {
            $info = $this->upload->data();
            $image_path = $info['file_name'];
            // delete the images present in table or else with every new upload unwanted files will keep on increasing
        } else {
            echo $this->upload->display_errors();
            return "";
        }
        return $image_path;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //LOGOUT
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function logout()
    {
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('user_data');
        redirect('index.php/google_login/login');
    }
}
