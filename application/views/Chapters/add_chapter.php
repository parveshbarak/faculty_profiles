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
                Chapters
            </div>
            <form id="add_chapter_form" method="POST" enctype="multipart/form-data">
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="ChapterTitle">Chapter Title</label>
                    <input type="text" class="form-control" id="ChapterTitle" name="ChapterTitle" autocomplete="none">
                </div>
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ChapterBook">Chapter Book</label>
                        <input type="text" class="form-control" id="ChapterBook" name="ChapterBook" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ChapterScoper">Chapter Scoper</label>
                        <input type="text" name="ChapterScoper" class="form-control" id="ChapterScoper" autocomplete="none">
                    </div>
                </div>
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ChapterPage">Chapter Page </label>
                        <input type="text" class="form-control" id="ChapterPage" name="ChapterPage" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="ChapterPublisher">Chapter Publisher</label>
                        <input type="text" class="form-control" id="ChapterPublisher" autocomplete="none" name="ChapterPublisher">
                    </div>
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="CYear">Chapter Publishing Year</label>
                        <input type="text" class="form-control" id="CYear" name="CYear" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="CMonth">Chapter Publishing Month</label>
                        <input type="text" class="form-control" id="CMonth" name="CMonth" autocomplete="none">
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
            var aProof = new FormData($("#add_chapter_form")[0]);
            $.ajax({
                url: 'http://localhost/faculty_profiles/index.php/google_login/add_chapter',
                type: 'POST',
                data: aProof,
                contentType: false,
                processData: false,
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    alert(data); //data return after past from controller
                }
            });
            return false;
        });
    </script>

</body>

</html>