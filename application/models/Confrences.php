<?php
class Confrences extends CI_Model
{
   function __construct()
   {
      // Call the Model constructor  
      parent::__construct();
   }
   //we will use the select function  
   public function select($code)
   {
      //data is retrive from this query  
      $query = $this->db->query("SELECT * FROM confrences WHERE user_id='$code'");
      $result = $query->result();

      return $result;
   }

   public function select4($code, $id)
   {
      //data is retrive from this query 
      $query = $this->db->query("SELECT * FROM confrences WHERE user_id='$code' AND id = '$id'");
      $result = $query->result();
      return $result;
   }

   public function select2()
   {
      //data is retrive from this query 
      $code = "GKV/061";
      $query1 = $this->db->query("SELECT * FROM faculties WHERE user_id='$code'");
      $query2 = $this->db->query("SELECT * FROM journals WHERE user_id='$code'");
      $query3 = $this->db->query("SELECT * FROM confrences WHERE user_id='$code'");
      $query4 = $this->db->query("SELECT * FROM lectures WHERE user_id ='$code' ");
      $query5 = $this->db->query("SELECT * FROM books WHERE user_id='$code'");
      $result1 = $query1->result();
      $result2 = $query2->result();
      $result3 = $query3->result();
      $result4 = $query4->result();
      $result5 = $query5->result();

      return array($result1, $result2, $result3, $result4, $result5);
   }

   public function code_select($email)
   {
      // get code using email
      $query = $this->db->query("Select Code from users WHERE email = '$email'");
      $result = $query->result();
      return $result;
   }

   public function select3($code)
   {
      //data is retrive from this query
      $query1 = $this->db->query("SELECT * FROM faculties WHERE user_id='$code'");
      $query2 = $this->db->query("SELECT * FROM journals WHERE user_id='$code'");
      $query3 = $this->db->query("SELECT * FROM confrences WHERE user_id='$code'");
      $query4 = $this->db->query("SELECT * FROM lectures WHERE user_id ='$code' ");
      $query5 = $this->db->query("SELECT * FROM books WHERE user_id='$code'");
      $result1 = $query1->result();
      $result2 = $query2->result();
      $result3 = $query3->result();
      $result4 = $query4->result();
      $result5 = $query5->result();

      return array($result1, $result2, $result3, $result4, $result5);
   }

   public function confrence($data, $code, $id)
   {
      
   }
}
