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
                Journals
            </div>
            <form id="add_book_form" method="POST" enctype="multipart/form-data">
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="PublType">Publication Type </label>
                        <select id="PublType" class="form-control" required name="PublType">
                            <option value="SCOPUS" >National</option>
                            <option value="UGC CARE" >International</option>
                        </select>
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="Authors">Authors</label>
                        <input type="text" name="Authors" class="form-control" id="Authors" autocomplete="none">
                    </div>
                </div>
                <div class="form-group ml-3">
                    <label class="label" for="Paper">Paper</label>
                    <input type="text" name="Paper" class="form-control" id="Paper" autocomplete="none">
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="JournalName">Journal Name </label>
                        <input type="text" class="form-control" id="JournalName" name="JournalName" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ISSN">ISSN</label>
                        <input type="text" class="form-control" id="ISSN" name="ISSN" autocomplete="none">
                    </div>
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="Page">Pages </label>
                        <input type="text" class="form-control" id="Page" name="Page" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="Impact">Impact </label>
                        <input type="text" class="form-control" id="Impact" name="Impact" autocomplete="none">
                    </div>
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="APIList">API List </label>
                        <input type="text" class="form-control" id="APIList" name="APIList" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="APICount">API Count </label>
                        <input type="text" class="form-control" id="APICount" name="APICount" autocomplete="none">
                    </div>
                </div>
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="Scope">Scope</label>
                        <select id="Scope" class="form-control" required name="Scope">
                            <option value="SCOPUS" >SCOPUS</option>
                            <option value="UGC CARE" >UGC CARE</option>
                            <option value="SCI" >SCI</option>
                            <option value="Others" >Others</option>
                        </select>
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="JMonth">Month of Publication</label>
                        <input type="text" class="form-control" id="JMonth" name="JMonth" autocomplete="none">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 mt-3 ml-3">
                        <label class="label" for="JYear">Year of Publication</label>
                        <input type="text" name="JYear" class="form-control" id="JYear" autocomplete="none">
                    </div>
                    <div class="form-group col-md-6 mt-3 ml-3">
                        <label class="label" for="PublVol">Publication Volume</label>
                        <input type="text" class="form-control" id="PublVol"autocomplete="none" name="PublVol">
                    </div>
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="PublIssue">Publication Issue</label>
                        <input type="text" class="form-control" id="PublIssue" name="PublIssue" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="PublDOI">Publication DOI</label>
                        <input type="text" class="form-control" id="PublDOI" name="PublDOI" autocomplete="none">
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
            var data = $('#add_book_form').serialize();
            $.ajax({
                url: 'http://localhost/faculty_profiles/index.php/google_login/add_book',
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
        function preview_image(input){
            var file = $("input[type=file]").get(0).files[0];
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#output_image").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>
</html>