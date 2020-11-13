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
   }  
?> 