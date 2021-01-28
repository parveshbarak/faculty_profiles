<?php
//print_r($h); die;
//echo base_url(); die;
$count =0;
?>

<html>
    <head>
        <!-- <link rel="stylesheet" href="static/css/profile.css"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="heading">
                <h3>Confrences List</h3>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Publication</th>
                        <th scope="col">Topic</th>
                        <th scope="col">Date</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($h as $conf) { 
                        $count++;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $count; ?></th>
                            <td><?php echo $conf->ConfType ?></td>
                            <td><?php echo $conf->ConfTopic ?></td>
                            <td><?php echo $conf->ConfDateFm ?></td>
                            <td><a href="<?php echo base_url(); ?>index.php/google_login/edit_confrences/<?php echo $conf->id ?>">Edit </a> </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>

