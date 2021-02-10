<?php
$conferences = array("National","International");
?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/profile.css">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-light bg-light main-bar">
          <div class="container-fluid">
            <a class="btn btn-outline-success me-2 navbar-brand" href="<?php echo base_url(); ?>index.php/google_login/all_confrences">
              Confrence List
            </a>
          </div>
        </nav>
        <div class="generic_form">
            <div class="form-title text-center">
                Confrences
            </div>
            <form id="confrence_form" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="Id" name="Id" value="<?php echo $h['0']->id ?>">
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ConfType">Confrence Type</label>
                        <select id="ConfType" class="form-control" required name="ConfType">
                            <?php foreach ($conferences as $conference) { ?>
                                <option value="<?= $conference ?>" <?= $conference == $h['0']->ConfType ? "selected" : "" ?>><?= $conference ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ConfPlace">Confrrence Place</label>
                        <input type="text" class="form-control" id="ConfPlace" name="ConfPlace" value="<?php echo $h['0']->ConfPlace ?>" autocomplete="none">
                    </div>
                </div>
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="ConfTopic">Confrence Topic</label>
                    <input type="text" name="ConfTopic" class="form-control" id="ConfTopic" value="<?php echo $h['0']->ConfTopic ?>" autocomplete="none">
                </div>
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="ConfOrgBy">Confrence Organised By</label>
                    <input type="text" class="form-control" id="ConfOrgBy" value="<?php echo $h['0']->ConfOrgBy ?>" autocomplete="none" name="ConfOrgBy">
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ConfDateFm">Confrence Date from</label>
                        <input type="text" class="form-control" id="ConfDateFm" name="ConfDateFm" value="<?php echo $h['0']->ConfDateFm == "NA" ? "" : $h['0']->ConfDateFm ?>" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ConfDateTo">Confrence Date To</label>
                        <input type="text" class="form-control" id="ConfDateTo" name="ConfDateTo" value="<?php echo $h['0']->ConfDateTo == "NA" ? "" : $h['0']->ConfDateTo ?>" autocomplete="none">
                    </div>
                </div>
                <div class="form-group mt-3 ml-3 ">
                    <div>
                        <label class="label">Upload Certifiacte/Document of Journal</label>
                        <input type="file" id="image_path" name="image_path" class="image_path" onchange="preview_image(this)">
                    </div>
                    <div class="output_image_container">
                        <small>Certifiacte/Document size should be less than 128kb.</small>
                    </div>
                </div>
                
                <div class="form-group form_button_right ">
                    <button type="submit" class="sbmt_btn btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

<!--------------------------------------------------------------------------------------------------------------------------------------------------->
    <!-- JS PART -->
<!--------------------------------------------------------------------------------------------------------------------------------------------------->

    <script type="text/javascript">
        $("button").click(function() {
            var data = $('#confrence_form').serialize();
            $.ajax({
                url: 'http://localhost/faculty_profiles/index.php/google_login/update_confrence',
                type: 'POST',
                data: data,
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    alert(data);  //data return after past from controller
                }
            });
            return false;
        });
    </script>

</body>
</html>