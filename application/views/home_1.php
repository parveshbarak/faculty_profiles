<html xmlns="http://www.w3.org/1999/xhtml">  
   <head>  
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
      <title>Untitled Document</title>  
   </head>  
   <table border="1">  
      <tbody>  
         <tr>  
            <td>Email ID</td>  
            <td>Place </td>  
            <td>Book </td>  
         </tr>  
         <?php  //print_r($h); die();
         foreach ($h[0] as $row)  
         {  
            ?><tr>  
            <td><?php echo $row->EmailID;?></td>  
            <td><?php echo $row->Place;?></td>  
            <td><?php echo $row->Place;?></td>  
            </tr>  
         <?php }  
         ?>  
      </tbody>  
   </table>  
<body>  
</body>  
</html> 