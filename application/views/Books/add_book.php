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
                Books
            </div>
            <form id="add_book_form" method="POST" enctype="multipart/form-data">
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="BookTitle">Book Title</label>
                    <input type="text" class="form-control" id="BookTitle" name="BookTitle" autocomplete="none">
                </div>
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="BookAuthor">Book Author</label>
                        <input type="text" class="form-control" id="BookAuthor" name="BookAuthor" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="BookCoAuthor">Co-Author</label>
                        <input type="text" name="BookCoAuthor" class="form-control" id="BookCoAuthor" autocomplete="none">
                    </div>
                </div>
                <div class="form-group  col-md-6 mt-3 ml-3">
                    <label class="label" for="Editor">Editor</label>
                    <input type="text" name="Editor" class="form-control" id="Editor" autocomplete="none">
                </div>
                <div class="form-group  col-md-6 mt-3 ml-3">
                    <label class="label" for="BookPublication">Book Publication</label>
                    <input type="text" class="form-control" id="BookPublication" autocomplete="none" name="BookPublication">
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="BookISBN">Book ISBN </label>
                        <input type="text" class="form-control" id="BookISBN" name="BookISBN" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="BookPYear">Book Publication Year</label>
                        <input type="text" class="form-control" id="BookPYear" name="BookPYear" autocomplete="none">
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
            var aProof = new FormData($("#add_book_form")[0]);
            $.ajax({
                url: 'http://localhost/faculty_profiles/index.php/google_login/add_book',
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

        function preview_image(input) {
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $("#output_image").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>

</html>