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
            <a class="btn btn-outline-success me-2 navbar-brand" href="<?php echo base_url(); ?>index.php/google_login/all_books">
              Book List
            </a>
          </div>
        </nav>
        <div class="generic_form">
            <div class="form-title text-center">
                Books
            </div>
            <form id="book_form" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="Id" name="Id" value="<?php echo $h['0']->id ?>">
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="BookTitle">Book Title</label>
                    <input type="text" class="form-control" id="BookTitle" name="BookTitle" value="<?php echo $h['0']->BookTitle ?>" autocomplete="none">
                </div>
                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="BookAuthor">Book Author</label>
                        <input type="text" class="form-control" id="BookAuthor" name="BookAuthor" value="<?php echo $h['0']->BookAuthor ?>" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="BookCoAuthor">Co-AUthor</label>
                        <input type="text" class="form-control" id="BookCoAuthor" name="BookCoAuthor" value="<?php echo $h['0']->BookCoAuthor ?>" autocomplete="none">
                    </div>
                </div>
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="Editor">Editor</label>
                    <input type="text" name="Editor" class="form-control" id="Editor" value="<?php echo $h['0']->Editor ?>" autocomplete="none">
                </div>
                <div class="form-group mt-3 ml-3">
                    <label class="label" for="BookPublication">Book Publication</label>
                    <input type="text" class="form-control" id="BookPublication" value="<?php echo $h['0']->BookPublication ?>" autocomplete="none" name="BookPublication">
                </div>

                <div class="form-row row">
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="BookISBN">Book ISBN </label>
                        <input type="text" class="form-control" id="BookISBN" name="BookISBN" value="<?php echo $h['0']->BookISBN == "NA" ? "" : $h['0']->BookISBN ?>" autocomplete="none">
                    </div>
                    <div class="form-group  col-md-6 mt-3 ml-3">
                        <label class="label" for="BookPYear">Book Publication Year</label>
                        <input type="text" class="form-control" id="BookPYear" name="BookPYear" value="<?php echo $h['0']->BookPYear == "NA" ? "" : $h['0']->BookPYear ?>" autocomplete="none">
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
                url: 'http://localhost/faculty_profiles/index.php/google_login/update_book',
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