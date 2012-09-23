<script type="text/javascript">

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
                '<?php echo site_url('/ajax_cont/search');?>',
                {
                    "email":email
                },
                function(data) {
                    if(data.success)
                    {
                         $('#message').text("");
                    $('table#tbl_search_records').find('tr:not(:has(th))').remove();
                    $("#search_records_template").tmpl(data.record).appendTo("#tbl_search_records");
                    }
                    else
                    {
                        $('table#tbl_search_records').find('tr:not(:has(th))').remove();
                         $('#message').text("Email not found");
                        // alert("Email not found");
                    }

                }, 'json');


    }

    



</script>

    

<script type="text/html" id="search_records_template">
    <tr>
        <td>${id}</td>
        <td>${name}</td>
        <td>${email}</td>
        <td>${gender}</td>
    </tr>
</script>



<form>
    <div>
    <span>
          <label>Search_Email:</label>
    </span>
    <span>
        <input type="text" name="email" id="txt_email"/>
    </span>
    <span>
        <input type="button" value="Search" style="margin-top: 8px;" onclick="search()"/>
    </span>
    </div>
</form>

    <div id="message" style=" color: red;"></div>

<table id="tbl_search_records">
    <thead>
    <tr>
        <th>
            Id
        </th>
        <th>
            Name
        </th>
        <th>
            Email
        </th>
        <th>
            Gender
        </th>
    </tr>
    </thead>
    <tbody>

    </tbody>

</table>


    <select name="customers" onchange="showCustomer(this.value)">
<option value="">Select a customer:</option>
<option value="ALFKI">Alfreds Futterkiste</option>
<option value="NORTS ">North/South</option>
<option value="WOLZA">Wolski Zajazd</option>
</select>

