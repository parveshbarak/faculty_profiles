<?php
$scopes= array("UGC","SCI","Others","SCOPUS");
$publications = array("National","International");
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
            <a class="btn btn-outline-success me-2 navbar-brand" href="<?php echo base_url(); ?>index.php/google_login/all_journals">
              Journal List
            </a>
          </div>
        </nav>
        <div class="generic_form">
            <div class="form-title text-center">
                Journals
            </div>
            <form id="book_form" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="Id" name="Id" value="<?php echo $h['0']->id ?>">
                
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="PublType">Publication Type</label>
                        <select id="PublType" class="form-control" required name="PublType">
                            <?php foreach ($publications as $publication) { ?>
                                <option value="<?= $publication ?>" <?= $publication == $h['0']->PublType ? "selected" : "" ?>><?= $publication ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="Authors">Authors</label>
                        <input type="text" class="form-control" id="Authors" name="Authors" value="<?php echo $h['0']->Authors ?>" autocomplete="none">
                    </div>
                </div>
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="Paper">Paper</label>
                    <input type="text" name="Paper" class="form-control" id="Paper" value="<?php echo $h['0']->Paper ?>" autocomplete="none">
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="JournalName">Journal Name </label>
                        <input type="text" class="form-control" id="JournalName" name="JournalName" value="<?php echo $h['0']->JournalName == "NA" ? "" : $h['0']->JournalName ?>" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ISSN">ISSN</label>
                        <input type="text" class="form-control" id="ISSN" name="ISSN" value="<?php echo $h['0']->ISSN == "NA" ? "" : $h['0']->ISSN ?>" autocomplete="none">
                    </div>
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="Page">Pages</label>
                        <input type="text" class="form-control" id="Page" name="Page" value="<?php echo $h['0']->Page ?>" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="Impact">Impact </label>
                        <input type="text" class="form-control" id="Impact" name="Impact" value="<?php echo $h['0']->Impact ?>" autocomplete="none">
                    </div>
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="APIList">API List</label>
                        <input type="text" class="form-control" id="APIList" name="APIList" value="<?php echo $h['0']->APIList ?>" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="APICount">API Count</label>
                        <input type="text" class="form-control" id="APICount" name="APICount" value="<?php echo $h['0']->APICount ?>" autocomplete="none">
                    </div>
                </div>
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="Scope">Scope</label>
                        <select id="Scope" class="form-control" required name="Scope">
                            <?php foreach ($scopes as $scope) { ?>
                                <option value="<?= $scope ?>" <?= $scope == $h['0']->Scope ? "selected" : "" ?>><?= $scope ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="JMonth">Month of Publishing</label>
                        <input type="text" class="form-control" id="JMonth" name="JMonth" value="<?php echo $h['0']->JMonth ?>" autocomplete="none">
                    </div>
                </div>
                <div class="form-row row">
                    <div class="form-group col-md-6 mt-3 ml-3">
                        <label class="label" for="JYear">Year of Publishing</label>
                        <input type="text" name="JYear" class="form-control" id="JYear" value="<?php echo $h['0']->JYear ?>" autocomplete="none">
                    </div>
                    <div class="form-group col-md-6 mt-3 ml-3">
                        <label class="label" for="PublVol">Publication Volume</label>
                        <input type="text" class="form-control" id="PublVol" value="<?php echo $h['0']->PublVol ?>" autocomplete="none" name="PublVol">
                    </div>
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="PublIssue">Publication Issue</label>
                        <input type="text" class="form-control" id="PublIssue" name="PublIssue" value="<?php echo $h['0']->PublIssue == "NA" ? "" : $h['0']->PublIssue ?>" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="PublDOI">Publication DOI</label>
                        <input type="text" class="form-control" id="PublDOI" name="PublDOI" value="<?php echo $h['0']->PublDOI == "NA" ? "" : $h['0']->PublDOI ?>" autocomplete="none">
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
            var data = $('#book_form').serialize();
            $.ajax({
                url: 'http://localhost/faculty_profiles/index.php/google_login/update_journal',
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