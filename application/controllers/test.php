
    
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
            $this->form_validation->set_rules('PublType', 'Journal Type', 'required');
            $this->form_validation->set_rules('Authors', 'Confrrence Place', 'required');
            $this->form_validation->set_rules('Paper', 'Journal Topic', 'required');
            $this->form_validation->set_rules('JournalName', 'Journal Organised By', 'required');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $code = $this->session->userdata['user_data']['code']['Code'];
                $form_data = $this->input->post(); 
                $id = $form_data['Id']; 
                $this->load->model('Journals');
                $result = $this->Journals->update_journal($form_data,$code,$id);
                if($result) {
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
            $this->form_validation->set_rules('PublType', 'Journal Type', 'required');
            $this->form_validation->set_rules('Authors', 'Confrrence Place', 'required');
            $this->form_validation->set_rules('Paper', 'Journal Topic', 'required');
            $this->form_validation->set_rules('JournalName', 'Journal Organised By', 'required');
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
                $result = $this->Journals->add_journal($form_data,$code,$serial_no,$image_path);
                if($result) {
                    echo "Journal successfully Added";
                } else {
                    echo "Something Went Wrong! ";
                }
            }
        }
    }