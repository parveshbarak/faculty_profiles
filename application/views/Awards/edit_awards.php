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
            <a class="btn btn-outline-success me-2 navbar-brand" href="<?php echo base_url(); ?>index.php/google_login/all_awards">
              Award List
            </a>
          </div>
        </nav>
        <div class="generic_form">
            <div class="form-title text-center">
                Award
            </div>
            <form id="award_form" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="Id" name="Id" value="<?php echo $h['0']->id ?>">
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="AwardName">Award Name</label>
                    <input type="text" class="form-control" id="AwardName" name="AwardName" value="<?php echo $h['0']->AwardName ?>" autocomplete="none">
                </div>
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="AwardAgency">Award Agency</label>
                        <input type="text" class="form-control" id="AwardAgency" name="AwardAgency" value="<?php echo $h['0']->AwardAgency ?>" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="AwardYear">Award Year</label>
                        <input type="text" class="form-control" id="AwardYear" name="AwardYear" value="<?php echo $h['0']->AwardYear ?>" autocomplete="none">
                    </div>
                </div>
                
                <div class="form-group mt-3 ml-3 ">
                    <div>
                        <label class="label">Upload Certifiacte/Document of Journal</label>
                        <input type="file" id="image_path" name="image_path" class="image_path" value="<?php echo $h['0']->image_path ?>">
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
            var aProof = new FormData($("#award_form")[0]);
            $.ajax({
                url: 'http://localhost/faculty_profiles/index.php/google_login/update_award',
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