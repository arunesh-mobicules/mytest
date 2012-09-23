<script type="text/javascript">

    function validate() {
        if ($('#txt_name').val() == null || $('#txt_name').val() == "") {
            alert("Please enter your name");
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


    function save() {
        var name = $('#txt_name').val();
        var email = $('#txt_email').val();
        var gender = $("input[@name=gender]:checked").val();

        if (!validate())
        {
            return false;
        }

        $.post('<?php echo site_url('/test/submit');?>',
                {
                    "name":name,
                    "email":email,
                    "gender":gender
                },
                function(data) {
                    if (data.success) {
                        $('#message').text(data.message);
                    }
                    else {
                        $('#email_error_message').text(data.message);
                    }

                }, 'json'
        );

    }


</script>

<form style="margin-left: 105px;">
    <div id="message" style=" color: red;"></div>
    <label>Name:</label>
    <input id="txt_name" name="name" title="text" style="margin-bottom: 9px; margin-left: -1px;"><br>
    <label>Email:</label>
    <input id="txt_email" email="name" title="text" style="margin-bottom: 9px;">

    <div id="email_error_message" style=" color: red;"></div>
    <label>Gender:</label>
    <input class="radio_gender" type="radio" value="male" name="gender" checked="checked" style="margin-bottom: 9px;">Male
    <input class="radio_gender" type="radio" value="female" name="gender" style="margin-bottom: 9px;">Female<br>
    <input type="button" value="Submit" style="width: 78px; margin-left: 107px; padding-left: 0px; padding-right: 0px;"
           onclick="save()"/>
</form>

