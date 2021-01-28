<?php
// print_r($h['0']); die;
?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/profile.css">

</head>

<body>
    <div class="container">
        <div class="generic_form">
            <div class="form-title text-center">
                Confrences
            </div>
            <form id="confrence_form" method="POST" enctype="multipart/form-data">

                
                <div class="form-group ">
                    <div class="output_image_container">
                        <img id="output_image" src="<?php echo 'profile' ?>" />
                        <small>Image size should be less than 128kb.</small>
                    </div>
                    <div>
                        <input type="file" id="profile_photo" name="profile_photo" class="form-control-file" onchange="preview_image(event)">
                    </div>
                </div>
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="confrence_type">Confrence Type</label>
                        <input type="text" class="form-control" id="confrence_type" name="confrence_type" value="<?php echo $h['0']->ConfType ?>" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="confrence_place">Confrrence Place</label>
                        <input type="text" class="form-control" id="confrence_place" name="confrence_place" value="<?php echo $h['0']->ConfPlace ?>" autocomplete="none">
                    </div>
                </div>
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="confrence_topic">Confrence Topic</label>
                    <input type="text" name="confrence_topic" class="form-control" id="confrence_topic" value="<?php echo $h['0']->ConfTopic ?>" autocomplete="none">
                </div>
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="confrence_organised_by">Confrence Organised By</label>
                    <input type="text" class="form-control" id="confrence_organised_by" value="<?php echo $h['0']->ConfOrgBy ?>" autocomplete="none" name="confrence_organised_by">
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="confrence_date_fm">Confrence Date from</label>
                        <input type="text" class="form-control" id="confrence_date_fm" name="confrence_date_fm" value="<?php echo $h['0']->ConfDateFm == "NA" ? "" : $h['0']->ConfDateFm ?>" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="confrence_date_to">Confrence Date To</label>
                        <input type="text" class="form-control" id="confrence_date_to" name="confrence_date_to" value="<?php echo $h['0']->ConfDateTo == "NA" ? "" : $h['0']->ConfDateTo ?>" autocomplete="none">
                    </div>
                </div>
                <div class="form-group form_button_right ">
                    <!-- <input type="submit" class="sbmt_btn btn btn-primary" value="Submit"> -->
                    <button type="submit" class="sbmt_btn btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>



    <!-- <script src="<?php echo base_url(); ?>static/js/confrence.js"></script> -->

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