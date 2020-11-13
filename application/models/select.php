<?php
class Select_model extends CI_Model 
{
   /*View*/
	function display_records()
	{
	$query=$this->db->query("select * from lectures");
	return $query->result();
	}
	
} 