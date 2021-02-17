<?php
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
            <a class="btn btn-outline-success me-2 navbar-brand" href="<?php echo base_url(); ?>index.php/google_login/login">
              My Profile
            </a>
          </div>
        </nav>
        <div class="generic_form">
            <div class="form-title text-center">
                Confrences
            </div>
            <form id="add_confrence_form" method="POST" enctype="multipart/form-data">
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ConfType">Confrence Type</label>
                        <input type="text" class="form-control" id="ConfType" name="ConfType" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ConfPlace">Confrrence Place</label>
                        <input type="text" class="form-control" id="ConfPlace" name="ConfPlace" autocomplete="none">
                    </div>
                </div>
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="ConfTopic">Confrence Topic</label>
                    <input type="text" name="ConfTopic" class="form-control" id="ConfTopic" autocomplete="none">
                </div>
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="ConfOrgBy">Confrence Organised By</label>
                    <input type="text" class="form-control" id="ConfOrgBy"autocomplete="none" name="ConfOrgBy">
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ConfDateFm">Confrence Date from</label>
                        <input type="text" class="form-control" id="ConfDateFm" name="ConfDateFm" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ConfDateTo">Confrence Date To</label>
                        <input type="text" class="form-control" id="ConfDateTo" name="ConfDateTo" autocomplete="none">
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
                    <!-- <input type="submit" class="sbmt_btn btn btn-primary" value="Submit"> -->
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
            var aProof = new FormData($("#add_confrence_form")[0]);
            $.ajax({
                url: 'http://localhost/faculty_profiles/index.php/google_login/add_confrence',
                type: 'POST',
                data: aProof,
                contentType: false,
                processData: false,
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