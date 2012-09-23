<script type="text/javascript ">

    function validate() {

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


    function search() {
        var email = $('#txt_email').val();
        if (!validate()) {
            return false;
        }
        $.post(
                '<?php echo site_url('/test/search');?>',
                {
                    "email":email
                },
                function(data) {
                    if (data.success) {
                        $('#message').text("");
                        $('table#tbl_search_records').find('tr:not(:has(th))').remove();
                        $("#search_records_template").tmpl(data.record).appendTo("#tbl_search_records");
                    }
                    else {
                        $('table#tbl_search_records').find('tr:not(:has(th))').remove();
                        $('#message').text("Email not found");
                        // alert("Email not found");
                    }

                }, 'json');


    }


    function search_select() {

        var gender = $("#gender").val();
        //alert(gender);
        $.post('<?php echo site_url('/test/search_select');?>',
                {

                    "gender":gender
                }, function(data) {
                   $('table#tbl_search_records').find('tr:not(:has(th))').remove();
                        $("#search_records_template").tmpl(data.record).appendTo("#tbl_search_records");

                }, 'json'
        );
    }


</script>

<script type="text/html" id="search_records_template">
    <tr>
        <td>${id}</td>
        <td>${name}</td>
        <td>${email}</td>
        <td>${gender}</td>
         <td><a href="<?php echo site_url('/test/delete');?>?id=${id}> ">Delete</a></td>
         <td><a href="<?php echo site_url('/test/update');?>?id=${id} ">Update</a></td>
    </tr>
</script>



<table id="tbl_search_records">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th colspan="2">Action</th>
    </tr>
    </thead>

    <tbody>
    <?php if (isset($records)): foreach ($records as $row): ?>
     <tr>
       <td> <?php echo $row->id;?></td>
        <td> <?php echo $row->name;?></td>
        <td> <?php echo $row->email;?></td>
        <td> <?php echo $row->gender;?></td>
        <td><a href="<?php echo site_url('/test/delete');?>?id=<?php echo $row->id;?> ">Delete</a></td>
        <td><a href="<?php echo site_url('/test/update');?>?id=<?php echo $row->id;?> ">Update</a></td>

        <?php endforeach; ?>
     </tr>
    <?php endif;?>
    <br>
    </tbody>
</table>
<div id="message" style=" color: red;"></div>
<form>
    <table>
        <tr>
            <td valign="bottom">
                <div style="margin-top: 8px;"></div>
                <label>Search by Email:</label></div></td>
            <td valign="bottom"><input type="text" name="email" id="txt_email"/></td>
            <td valign="bottom"><input type="button" value="Search" style="margin-top: 8px;" onclick="search()"></td>
        </tr>

    </table>
</form>

<form name="form2">
    <label>Search by gender:</label>
    <select name="gender" id="gender" onchange="search_select()">
        <option value="male">male</option>
        <option value="female">female</option>

    </select>
</form>