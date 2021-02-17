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
                <h4>Book List</h4>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Award Name</th>
                        <th scope="col">Award Agency</th>
                        <th scope="col">Year of Recieving</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($h as $award) { 
                        $count++;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $count; ?></th>
                            <td><?php echo $award->AwardName ?></td>
                            <td><?php echo $award->AwardAgency ?></td>
                            <td><?php echo $award->AwardYear ?></td>
                            <td><a href="<?php echo base_url(); ?>index.php/google_login/edit_awards/<?php echo $award->id ?>">Edit </a> </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>

