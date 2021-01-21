<?php
$page_info->add_css('/static/css/student/profile.css');
$page_info->add_js('/static/js/student/profile.js');

?>

<div class="container">
    <div  class="generic_form">
        <div class="form-title text-center">
            Confrences
        </div>
        <form id="profile_form" method="POST" enctype="multipart/form-data">

            <div class="form-group ">
                <div class="output_image_container">
                    <img id="output_image" src="<?php echo $profile_photo ?>"/>
                    <small>Image size should be less than 128kb.</small>
                </div>
                <div>
                    <input type="file" id="profile_photo" name="profile_photo" class="form-control-file" onchange="preview_image(event)">
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="text" class="form-control" id="email" value="<?php echo $email ?>" autocomplete="none" disabled>
            </div>
            <div class="form-group ">
                <label for="reg_no">Registration Number</label>
                <input type="text" class="form-control" id="reg_no" value="<?php echo $enrollment_number ?>" autocomplete="none" <?= $to_edit_registration_number ? "" : "readonly" ?> name="reg_no">
            </div>
            <div class="form-row">
                <div class="form-group  col-md-6">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name ?>" autocomplete="none">
                </div>
                <div class="form-group  col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name ?>" autocomplete="none">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group  col-md-6">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $mobile == "NA" ? "" : $mobile ?>" autocomplete="none">
                </div>
                <div class="form-group  col-md-6">
                    <label for="branch">Branch</label>
                    <select id="branch" class="form-control" required name="branch">
                        <option></option>
                        <?php foreach ($data['branches'] as $branch_row) { ?>
                            <option value="<?= $branch_row['branch'] ?>" <?= $branch == $branch_row['branch'] ? "selected" : "" ?>><?= $branch_row['label'] ?></option>
                        <?php }
                        ?>
                    </select>
                </div>             
            </div>
            <div class="form-group form_button_right ">
                <input type="submit" class="sbmt_btn btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
</div>