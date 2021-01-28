<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Faculty Profile</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/style.css">
</head>

<body>

<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">FET</a>
    <form class="d-flex">
      <button class="btn btn-outline-success">
        <?php
            if (!isset($login_button)) {
                echo '<h3><a href="' . base_url() . 'index.php/google_login/logout">Logout</h3></div>';
            } else {
                echo '<div align="center">' . $login_button . '</div>';
            }
        ?>
      </button>
    </form>
  </div>
</nav>

    <section class="left">
        <h1>Spotlight</h1>
        <ul type="none">
            <a href="https://www.gkv.ac.in/">
                <li>
                    Vishwavidyalaya Home
                </li>
            </a>
            <a href="https://www.gkv.ac.in/list-of-departments/">
                <li>
                    All Departments</li>
            </a>
            <a href="?page=faculty_will_be_taken_online">
                <li>
                    Faculty</li>
            </a>

            <a href="?page=facilities">
                <li>
                    Facilities</li>
            </a>
            <a href="?page=events%C2%A0organized
                   ">
                <li>Events Organized</li>
            </a>
            <a href="#">
                <li>
                    Important Contacts</li>
            </a>
        </ul>
    </section>

    <section class="right">
        <header>
            <h1><?php echo $h[0] ? $h[0][0]->Name : "" ?></h1>
            <p>
                <strong>Post :</strong> <?php echo $h[0] ? $h[0][0]->Post : "" ?><br><strong>Faculty :</strong><?php echo $h[0] ? $h[0][0]->Faculty : "" ?><br><strong>Department :</strong><?php echo $h[0] ? $h[0][0]->Dept : "" ?><br>
            </p>
        </header>

        <main>
            <section>
                <!-- ========================================================================== -->

                <?php if ($h[1]) { ?>
                    <h1>Journals</h1>
                    <?php  //echo print_r($h[1]);
                    foreach ($h[1] as $row) {
                    ?>
                        <p>
                            <strong>Publication :</strong><?php echo $row->PublType ?><br>
                            <strong>Author :</strong><?php echo $row->Authors ?><br>
                            <strong>Paper:</strong> <?php echo $row->Paper ?><br>
                            <strong>ISSN:</strong> <?php echo $row->ISSN ?>
                        </p>
                    <?php }} else { ?>
                    <!-- nothing to show -->
                <?php    } ?>
                <!-- =========================================================================== -->

                <?php if ($h[2]) { ?>
                <h1>Conference <a href="<?php echo base_url(); ?>index.php/google_login/all_confrences">Edit Confrences</a></h1>
                    <?php  //echo print_r($h[1]);
                    foreach ($h[2] as $row) {
                    ?>
                        <p>
                            <strong>Publication :</strong><?php echo $row->ConfType ?><br><strong>Topic :</strong> <?php echo $row->ConfTopic ?> <br><strong>Organized By:</strong> <?php echo $row->ConfOrgBy ?><br><strong>Date:</strong><?php echo $row->ConfDateFm ?>
                        </p>
                    <?php }} else { ?>
                    <!-- nothing to show -->
                <?php    } ?>
                <!-- =========================================================================== -->
                <?php if ($h[3]) { ?>
                    <h1>Lectures</h1>
                    <?php
                    foreach ($h[3] as $row) {
                    ?>
                        <p>
                            <strong>Lecture :</strong><?php echo $row->Lecture ?> <br><strong>Place :</strong><?php echo $row->Place ?> <br><strong>Date :</strong> <?php echo $row->LectureDtae ?>
                        </p>
                    <?php }} else { ?>
                    <!-- nothing to show -->
                <?php    } ?>
                <!-- ===========================================================================-->
                <?php if ($h[4]) { ?>
                    <h1>Books</h1>
                    <?php
                    foreach ($h[4] as $row) {
                    ?>
                        <p>
                            <strong>Authors :</strong><?php echo $row->BookAuthor ?>,<?php echo $row->BookCoAuthor ?> <br><strong>Title :</strong><?php echo $row->BookTitle ?><br><strong>Publication :</strong><?php echo $row->BookPublication ?><br><strong>ISBN :</strong><?php echo $row->BookISBN ?><br><strong>Page :</strong> <?php echo $row->Page ?>
                        </p>
                    <?php }} else { ?>
                    <!-- nothing to show -->
                <?php    } ?>

            </section>
        </main>
    </section>
</body>

</html>