<html>

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Faculty Page</title>
</head>
<div class="container">
   <table border="1">
      <tbody>
         <tr>
            <td>Email ID</td>
            <td>Place </td>
            <td>Book </td>
         </tr>
         <?php  //print_r($h); die();
         foreach ($h[0] as $row) {
         ?><tr>
               <td><?php echo $row->EmailID; ?></td>
               <td><?php echo $row->Lecture; ?></td>
               <td><?php echo $row->Place; ?></td>
            </tr>
         <?php }
         ?>
         <?php  //print_r($h); die();
         foreach ($h[1] as $row) {
         ?><tr>
               <td><?php echo $row->Code; ?></td>
               <td><?php echo $row->Name; ?></td>
               <td><?php echo $row->Post; ?></td>
               <td><?php echo $row->Faculty; ?></td>
               <td><?php echo $row->Dept; ?></td>
            </tr>
         <?php }
         ?>
      </tbody>
   </table>
   <h1><a href = "<?php echo base_url(); ?>faculty/faculty_display">dummy</a></h1>
   <h1><a href = "<?php echo base_url(); ?>faculty/">Profile</a></h1>
</div>

<body>
</body>

</html>