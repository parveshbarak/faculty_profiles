<?php
$count =0;
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/profile.css">
    </head>
    <body>
        <div class="container">
        <nav class="navbar navbar-light bg-light main-bar">
          <div class="container-fluid">
            <a class="btn btn-outline-success me-2 navbar-brand" href="<?php echo base_url(); ?>index.php/google_login/login">
              My Profile
            </a>
          </div>
        </nav>
            <div class="heading btn btn-secondry">
                <h4>Confrences List</h4>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Lecture</th>
                        <th scope="col">Place</th>
                        <th scope="col">Date</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($h as $lecture) { 
                        $count++;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $count; ?></th>
                            <td><?php echo $lecture->Lecture ?></td>
                            <td><?php echo $lecture->Place ?></td>
                            <td><?php echo $lecture->LectureDate ?></td>
                            <td><a href="<?php echo base_url(); ?>index.php/google_login/edit_lectures/<?php echo $lecture->id ?>">Edit </a> </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>

