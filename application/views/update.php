<script type="text/javascript">

    function validate() {
        if ($('#txt_name').val() == null || $('#txt_name').val() == "") {
           $('#name_error_message').text("Please enter your name");
            $('#txt_name').focus();
            return false;
        }

        var email = $('#txt_email').val();

        if (email == null || email == "") {
            alert("Please enter your email address");
            $('#txt_email').focus();
            return false;
        }

        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(email) == false) {
            alert("Please enter a valid email address");
            $('#txt_email').focus();
            return false;
        }

        return true;
    }


    function update() {

        var name = $('#txt_name').val();
        var email = $('#txt_email').val();
        var gender = $("input[@name=gender]:checked").val();
        var id = $('#record_id').val();

        if (!validate()) {
            return false;
        }

        $.post('<?php echo site_url('/test/update_row');?>',
                {
                    "name":name,
                    "email":email,
                    "gender":gender,
                    "id":id
                },
                function(data) {
                    //alert(data.message);
                    if (data.success) {

                    $('#message').text(data.message);
                    }
                   
                }, 'json'
        );

    }


</script>

<form style="margin-left: 105px;">
    <div id="message" style=" color: red;"></div>
    <input type="hidden" name="member_id"  id="record_id" value="<?php echo $id;?> style="margin-bottom: 9px; margin-left: -1px;""/>
    <?php if (isset($records)): foreach ($records as $row): ?>

    <label>Name</label>
    <input title="text" name="name" id="txt_name" value="<?php echo $row->name;?>" style="margin-bottom: 9px;"><br>
            <div id="name_error_message" style=" color: red;"></div>
    <label>Email</label>
    <input title="text" email="name" id="txt_email" value="<?php echo $row->email;?>"><br>
    <label>Gender</label>
    <input class="radio_gender" type="radio" <?php if ($row->gender == 'male'): ?>
           checked="checked" <?php endif;?> value="male" name="gender" style="margin-bottom: 9px;">Male
    <input class="radio_gender" type="radio"  <?php if ($row->gender == 'female'): ?>
           checked="checked" <?php endif;?> value="female" name="gender" style="margin-bottom: 9px;">Female<br>
    <input type="button" value="Submit" style="width: 78px; margin-left: 107px; padding-left: 0px; padding-right: 0px;" onclick="update()"/>

    <?php endforeach; ?>
    <?php endif;?>
</form>

