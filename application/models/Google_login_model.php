<?php

class Google_login_model extends CI_Model {

    function Is_already_register($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function Update_user_data($data, $email) {
        $this->update_users($data['users'], $email);
    }
    
    private function update_users($data, $email) {
        $this->db->where('email', $email);
        $this->db->update('users', $data);
    }
    
    
    function Insert_user_data($data) {
        $this->db->insert('users', $data);
    }

}

?>