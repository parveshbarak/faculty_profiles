<?php
class Awards extends CI_Model
{
   function __construct()
   {
      // Call the Model constructor  
      parent::__construct();
   }
   
   public function select($code)
   {
      $query = $this->db->query("SELECT * FROM awards WHERE user_id='$code'");
      $result = $query->result();

      return $result;
   }

   public function get_award($code, $id)
   {
      //data is retrive from this query 
      $query = $this->db->query("SELECT * FROM awards WHERE user_id='$code' AND id = '$id'");
      $result = $query->result();
      return $result;
   }

   public function update_award($data, $code, $id, $image_path)
   {
       $data['image_path'] = $image_path;
       $query = $this->db->WHERE('user_id',$code);
       $query = $this->db->WHERE('id',$id);
       $query = $this->db->UPDATE('awards', $data);
       if($query) {
           return true;
       } else {
           return false;
       }
   }

   public function add_award($data, $code, $serial_no,$image_path)
   {
       $query = $this->db->WHERE('user_id',$code);
       $data['user_id'] = $code; $data['serial_no'] = $serial_no; $data['image_path'] = $image_path;
       $query = $this->db->INSERT('awards', $data);
       if($query) {
           return true;
       } else {
           return false;
       }
   }
}
