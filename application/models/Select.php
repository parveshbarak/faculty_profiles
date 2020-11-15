<?php
class Select extends CI_Model
{
   function __construct()
   {
      // Call the Model constructor  
      parent::__construct();
   }
   //we will use the select function  
   public function select()
   {
      //data is retrive from this query  
      $query1 = $this->db->query("SELECT * FROM lectures");
      $query2 = $this->db->query("SELECT * FROM faculties");
      $result1 = $query1->result();
      $result2 = $query2->result();

      return array($result1, $result2);
   }

   public function select2()
   {
      //data is retrive from this query 
      $code = "GKV/061";
      $query1 = $this->db->query("SELECT * FROM faculties WHERE Code='$code'");
      $query2 = $this->db->query("SELECT * FROM journals WHERE EmailID='$code'");
      $query3 = $this->db->query("SELECT * FROM confrences WHERE EmailID='$code'");
      $query4 = $this->db->query("SELECT * FROM lectures WHERE EmailID ='$code' ");
      $query5 = $this->db->query("SELECT * FROM books WHERE EmailID='$code'");
      $result1 = $query1->result();
      $result2 = $query2->result();
      $result3 = $query3->result();
      $result4 = $query4->result();
      $result5 = $query5->result();

      return array($result1, $result2, $result3, $result4, $result5);
   }
}
