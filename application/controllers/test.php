
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