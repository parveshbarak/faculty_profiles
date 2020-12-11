
<?php

class Google_login_model extends CI_Model {

    function Is_already_register($id) {
        $this->db->where('password', $id);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function Update_user_data($data, $id) {
        //$data = json_decode(json_encode($data), TRUE);
        //print_r($data['query']['h']['0']['0']); die;
        $this->update_users($data['users'], $id);
        //$code = $data['query']['0']['Code'];
        //$this->update_awards($data['query']['h']['0'], $code);
        //$this->update_books($data['query']['h']['0'], $code);
        //$this->update_chapters($data['query']['h']['0'], $code);
        //$this->update_confrences($data['query']['h']['2'], $code);
        //$this->update_faculties($data['query']['h']['0']['0'], $code);
        //$this->update_journals($data['query']['h']['1'], $code);
        //$this->update_lectures($data['query']['h']['0'], $code);
    }
    
    private function update_users($data, $id) {
        $this->db->where('password', $id);
        $this->db->update('users', $data);
    }
    
    private function update_awards($data, $code) {
        $this->db->where('user_id', $code);
        $this->db->update('awards', $data);
    }
    
    private function update_books($data, $code) {
        $this->db->where('user_id', $code);
        $this->db->update('books', $data);
    }
    
    private function update_chapters($data, $code) {
        $this->db->where('user_id', $code);
        $this->db->update('chapters', $data);
    }
    
    private function update_confrences($data, $code) {
        $this->db->where('user_id', $code);
        $this->db->update('confrences', $data);
    }
    
    private function update_faculties($data, $code) {
        $this->db->where('user_id', $code);
        $this->db->update('faculties', $data);
    }
    
    private function update_journals($data, $code) {
        $this->db->where('user_id', $code);
        $this->db->update('journals', $data);
    }
    
    private function update_lectures($data, $code) {
        $this->db->where('user_id', $code);
        $this->db->update('lectures', $data);
    }
    
    

    function Insert_user_data($data) {
        $this->db->insert('users', $data);
    }

}

?>