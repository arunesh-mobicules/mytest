<h3>Submit</h3>
    <form action="<?php echo site_url('test/save');?>" method="post">
    Name: <input type="text" name="name"/><br/>
    Password:<input type="text" name="password"/>
        <input type="submit" value="submit"/>
    </form>

    <form action="<?php echo site_url('test/get_login');?>" method="post">
    Name: <input type="text" name="name_l"/><br/>
    Password:<input type="text" name="password_l"/>
        <input type="submit" value="submit"/>
    </form>