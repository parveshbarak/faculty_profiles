<?php

defined('BASEPATH') or exit('No direct script access allowed');

$redirect_page = 'http://localhost/faculty_profiles/index.php/google_login/login/1';
$journal_redirect = 'http://localhost/faculty_profiles/index.php/google_login/all_journals';
$conference_redirect = 'http://localhost/faculty_profiles/index.php/google_login/all_conferences';
$book_redirect = 'http://localhost/faculty_profiles/index.php/google_login/all_books';
$chapter_redirect = 'http://localhost/faculty_profiles/index.php/google_login/all_chapters';
$lecture_redirect = 'http://localhost/faculty_profiles/index.php/google_login/all_lectures';

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

    function login($id = NULL)
    {
        
        include_once APPPATH . "libraries/vendor/autoload.php";

        $google_client = new Google_Client();

        $google_client->setClientId('751169053910-382q6g08q97525vt4qp4qmchn8uutrgn.apps.googleusercontent.com'); //Define your ClientID

        $google_client->setClientSecret('oIvz-ebQoZi71e2owuTwWnr0'); //Define your Client Secret Key

        $google_client->setRedirectUri($GLOBALS['redirect_page']); //Define your Redirect Uri

        $google_client->addScope('email');

        $google_client->addScope('profile');

        if (isset($_GET["code"])) {
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

            if (!isset($token["error"])) {
                $google_client->setAccessToken($token['access_token']);

                $this->session->set_userdata('access_token', $token['access_token']);

                $google_service = new Google_Service_Oauth2($google_client);

                $data = $google_service->userinfo->get();

                if ($this->google_login_model->Is_already_register($data['email'])) {
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

                    $this->google_login_model->Update_user_data($user_data, $data['email']);
                    $this->session->set_userdata('user_data', $user_data);
                } else {
                    //Case-1 : insert data    
                    //We need to Make a code using His Email Id
//                    $code = 'GKV/062';
//
//                    $user_data = array(
//                        'name' => $data['given_name'],
//                        'email' => $data['email'],
//                        'password' => $data['id'],
//                        'code' => $code
//                    );
//                    $this->google_login_model->Insert_user_data($user_data, $data['id']);
//                    $this->session->set_userdata('user_data', $user_data);


                    // Case-2 : Do not insert data 
                    // show a message that you are  not a autheniticated user!
                    $this->session->unset_userdata('access_token');
                    $this->session->unset_userdata('user_data');
                    echo "<script>
                        alert('Please Make sure to USE GKV email! ');
                        window.location.href='http://localhost/faculty_profiles/index.php/google_login/login/1';
                        </script>";
                    //redirect($GLOBALS['redirect_page']);
                    //echo 'You are not allowed to login!!!';  // A alert message here!!

                }
            }
        }
        // Duumy Profile
        //In Future Replace it with Home Page of Faculties Data
        $this->load->model('Profile');
        $url = $_SERVER['REQUEST_URI'];
        $path = explode("/", $url); 
        $last = end($path);
        $normal_code = $this->Profile->get_code_from_serial_no($id);
        if($normal_code)
        {
            $query1['h'] = $this->Profile->profile($normal_code[0]->Code);
        } else {
            $query1['h'] = $this->Profile->profile('GKV/054');
        }


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
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Confrences');
            $data['h'] = $this->Confrences->select($code);
            $this->load->view('Confrences/all_confrences', $data);
        }
    }

    function edit_confrences($conf_id=NULL)
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Confrences');
            if($this->Confrences->get_confrence($code, $conf_id)) {
                $data['h'] = $this->Confrences->get_confrence($code, $conf_id);
                $this->load->view('Confrences/edit_confrences', $data);
            } else {
                echo 'No such Confrence';  // A alert message here!!
                redirect($GLOBALS['confrence_redirect']);
            }
        }
    }

    function new_confrence()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
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
            redirect($GLOBALS['redirect_page']);
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
                $image_path = $this->upload_file_and_get_path();
                $this->load->model('Confrences');
                $result = $this->Confrences->update_confrence($form_data, $code, $id, $image_path);
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
            redirect($GLOBALS['redirect_page']);
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
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Books');
            $data['h'] = $this->Books->select($code);
            $this->load->view('Books/all_books', $data);
        }
    }

    function edit_books($book_id=NULL)
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Books');
            if($this->Books->get_book($code, $book_id)) {
                $data['h'] = $this->Books->get_book($code, $book_id);
                $this->load->view('Books/edit_books', $data);
            } else {
                echo 'No such Book';  // A alert message here!!
                redirect($GLOBALS['book_redirect']);
            }
        }
    }

    function new_book()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
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
            redirect($GLOBALS['redirect_page']);
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
                $image_path = $this->upload_file_and_get_path();
                $this->load->model('Books');
                $result = $this->Books->update_book($form_data, $code, $id, $image_path);
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
            redirect($GLOBALS['redirect_page']);
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
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Journals');
            $data['h'] = $this->Journals->select($code);
            $this->load->view('Journals/all_journals', $data);
        }
    }

    function edit_journals($journal_id=NULL)
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Journals');
            if($this->Journals->get_journal($code, $journal_id)) {
                $data['h'] = $this->Journals->get_journal($code, $journal_id);
                $this->load->view('Journals/edit_journals', $data);
            } else {
                echo 'No such Journal';  // A alert message here!!
                redirect($GLOBALS['journal_redirect']);
            }
        }
    }

    function new_journal()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
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
            redirect($GLOBALS['redirect_page']);
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
                $image_path = $this->upload_file_and_get_path();
                $this->load->model('Journals');
                $result = $this->Journals->update_journal($form_data, $code, $id, $image_path);
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
            redirect($GLOBALS['redirect_page']);
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
    //AWARDS
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function all_awards()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Awards');
            $data['h'] = $this->Awards->select($code);
            $this->load->view('Awards/all_awards', $data);
        }
    }

    function edit_awards($award_id=NULL)
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Awards');
            if($this->Awards->get_award($code, $award_id)) {
                $data['h'] = $this->Awards->get_award($code, $award_id);
                $this->load->view('Awards/edit_awards', $data);
            } else {
                echo 'No such Award';  // A alert message here!!
                redirect($GLOBALS['award_redirect']);
            }
        }
    }

    function new_award()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->view('Awards/add_award');
        }
    }

    function update_award()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('AwardName', 'Award Name', 'required');
            $this->form_validation->set_rules('AwardAgency', 'Award Agency', 'required');
            $this->form_validation->set_rules('AwardYear', 'Award Year', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $code = $this->session->userdata['user_data']['code']['Code'];
                $form_data = $this->input->post();
                $id = $form_data['Id'];
                $image_path = $this->upload_file_and_get_path();
                $this->load->model('Awards');
                $result = $this->Awards->update_award($form_data, $code, $id, $image_path);
                if ($result) {
                    echo "Award successfully updated";
                } else {
                    echo "Something Went Wrong! ";
                }
            }
        }
    }

    function add_award()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('AwardName', 'Award Name', 'required');
            $this->form_validation->set_rules('AwardAgency', 'Award Agency', 'required');
            $this->form_validation->set_rules('AwardYear', 'Award Year', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $code = $this->session->userdata['user_data']['code']['Code'];
                $form_data = $this->input->post();
                $image_path = $this->upload_file_and_get_path();
                $this->load->model('Awards');
                $count = $this->Awards->select($code);
                $count = sizeof($count);
                $serial_no = $count + 1;
                $this->load->model('Awards');
                $result = $this->Awards->add_award($form_data, $code, $serial_no, $image_path);
                if ($result) {
                    echo "Award successfully Added";
                } else {
                    echo "Something Went Wrong! ";
                }
            }
        }
    }
    
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //CHAPTERS
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function all_chapters()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Chapters');
            $data['h'] = $this->Chapters->select($code);
            $this->load->view('Chapters/all_chapters', $data);
        }
    }

    function edit_chapters($chapter_id=NULL)
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Chapters');
            if($this->Chapters->get_chapter($code, $chapter_id)) {
                $data['h'] = $this->Chapters->get_chapter($code, $chapter_id);
                $this->load->view('Chapters/edit_chapters', $data);
            } else {
                echo 'No such Chapter';  // A alert message here!!
                redirect($GLOBALS['chapter_redirect']);
            }
        }
    }

    function new_chapter()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->view('Chapters/add_chapter');
        }
    }

    function update_chapter()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ChapterName', 'Chapter Name', 'required');
            $this->form_validation->set_rules('ChapterBook', 'Chapter Book', 'required');
            $this->form_validation->set_rules('ChapterPublisher', 'Chapter Publisher', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $code = $this->session->userdata['user_data']['code']['Code'];
                $form_data = $this->input->post();
                $id = $form_data['Id'];
                $image_path = $this->upload_file_and_get_path();
                $this->load->model('Chapters');
                $result = $this->Chapters->update_chapter($form_data, $code, $id, $image_path);
                if ($result) {
                    echo "Chapter successfully updated";
                } else {
                    echo "Something Went Wrong! ";
                }
            }
        }
    }

    function add_chapter()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ChapterName', 'Chapter Name', 'required');
            $this->form_validation->set_rules('ChapterBook', 'Chapter Book', 'required');
            $this->form_validation->set_rules('ChapterPublisher', 'Chapter Publisher', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $code = $this->session->userdata['user_data']['code']['Code'];
                $form_data = $this->input->post();
                $image_path = $this->upload_file_and_get_path();
                $this->load->model('Chapters');
                $count = $this->Chapters->select($code);
                $count = sizeof($count);
                $serial_no = $count + 1;
                $this->load->model('Chapters');
                $result = $this->Chapters->add_chapter($form_data, $code, $serial_no, $image_path);
                if ($result) {
                    echo "Chapter successfully Added";
                } else {
                    echo "Something Went Wrong! ";
                }
            }
        }
    }
    
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //LECTURES
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function all_lectures()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Lectures');
            $data['h'] = $this->Lectures->select($code);
            $this->load->view('Lectures/all_lectures', $data);
        }
    }

    function edit_lectures($lecture_id=NULL)
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $code = $this->session->userdata['user_data']['code']['Code'];
            $this->load->model('Lectures');
            if($this->Lectures->get_lecture($code, $lecture_id)) {
                $data['h'] = $this->Lectures->get_lecture($code, $lecture_id);
                $this->load->view('Lectures/edit_lectures', $data);
            } else {
                echo 'No such Lecture';  // A alert message here!!
                redirect($GLOBALS['lecture_redirect']);
            }
        }
    }

    function new_lecture()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->view('Lectures/add_lecture');
        }
    }

    function update_lecture()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Lecture', 'Lecture', 'required');
            $this->form_validation->set_rules('Place', 'Lecture Place', 'required');
            $this->form_validation->set_rules('LectureDate', 'Lecture Date', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $code = $this->session->userdata['user_data']['code']['Code'];
                $form_data = $this->input->post();
                $id = $form_data['Id'];
                $image_path = $this->upload_file_and_get_path();
                $this->load->model('Lectures');
                $result = $this->Lectures->update_lecture($form_data, $code, $id, $image_path);
                if ($result) {
                    echo "Lecture successfully updated";
                } else {
                    echo "Something Went Wrong! ";
                }
            }
        }
    }

    function add_lecture()
    {
        if (!$this->session->userdata('access_token')) {
            $this->session->unset_userdata('access_token');
            $this->session->unset_userdata('user_data');
            redirect($GLOBALS['redirect_page']);
            echo 'You are not allowed to login!!!';  // A alert message here!!
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Lecture', 'Lecture', 'required');
            $this->form_validation->set_rules('Place', 'Lecture Place', 'required');
            $this->form_validation->set_rules('LectureDate', 'Lecture Date', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $code = $this->session->userdata['user_data']['code']['Code'];
                $form_data = $this->input->post();
                $image_path = $this->upload_file_and_get_path();
                $this->load->model('Lectures');
                $count = $this->Lectures->select($code);
                $count = sizeof($count);
                $serial_no = $count + 1;
                $this->load->model('Lectures');
                $result = $this->Lectures->add_lecture($form_data, $code, $serial_no, $image_path);
                if ($result) {
                    echo "Lecture successfully Added";
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
        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
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
