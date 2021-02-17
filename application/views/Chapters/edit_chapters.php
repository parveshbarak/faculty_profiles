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
            <a class="btn btn-outline-success me-2 navbar-brand" href="<?php echo base_url(); ?>index.php/google_login/all_chapters">
              Chapter List
            </a>
          </div>
        </nav>
        <div class="generic_form">
            <div class="form-title text-center">
                Chapters
            </div>
            <form id="chapter_form" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="Id" name="Id" value="<?php echo $h['0']->id ?>">
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="ChapterTitle">Chapter Title</label>
                    <input type="text" class="form-control" id="ChapterTitle" name="ChapterTitle" value="<?php echo $h['0']->ChapterTitle ?>" autocomplete="none">
                </div>
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ChapterBook">Chapter Book</label>
                        <input type="text" class="form-control" id="ChapterBook" name="ChapterBook" value="<?php echo $h['0']->ChapterBook ?>" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ChapterScoper">Chapter Scoper</label>
                        <input type="text" class="form-control" id="ChapterScoper" name="ChapterScoper" value="<?php echo $h['0']->ChapterScoper ?>" autocomplete="none">
                    </div>
                </div>
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ChapterPage">Chapter Page </label>
                        <input type="text" class="form-control" id="ChapterPage" name="ChapterPage" value="<?php echo $h['0']->ChapterPage == "NA" ? "" : $h['0']->ChapterPage ?>" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ChapterPublisher">Chapter Publisher</label>
                        <input type="text" class="form-control" id="ChapterPublisher" value="<?php echo $h['0']->ChapterPublisher ?>" autocomplete="none" name="ChapterPublisher">
                    </div>
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="CYear">Chapter Publication Year</label>
                        <input type="text" class="form-control" id="CYear" name="CYear" value="<?php echo $h['0']->CYear == "NA" ? "" : $h['0']->CYear ?>" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="CMonth">Chapter Publication Month</label>
                        <input type="text" class="form-control" id="CMonth" name="CMonth" value="<?php echo $h['0']->CMonth == "NA" ? "" : $h['0']->CMonth ?>" autocomplete="none">
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
            var aProof = new FormData($("#chapter_form")[0]);
            $.ajax({
                url: 'http://localhost/faculty_profiles/index.php/google_login/update_chapter',
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