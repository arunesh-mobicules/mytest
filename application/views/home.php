<title>check</title>


<script type="text/javascript">
    function list() {
        location.href = "http://localhost/my/index.php/test/view_table";
    }
</script>



<?php echo "Home"; ?><br><br>
<p>Click add to add information <strong><a href="<?php echo site_url('/test/go_add');?>">ADD</a></strong></p>
<p>Click view to view information <strong><a href="<?php echo site_url('/test/view_table');?>">view</a></strong></p>


<input type="button" value="list" onclick="list()"/>





<?php echo form_open('test/validate'); ?>

<p>Username
    <input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50"/>
    <?php echo form_error('username'); ?></p>

<p>Mobile
    <input type="text" name="mobile" value="<?php echo set_value('mobile'); ?>" size="50"/>
    <?php echo form_error('mobile'); ?></p>

<p>Password
    <input type="text" name="password" value="<?php echo set_value('password'); ?>" size="50"/>
    <?php echo form_error('password'); ?></p>

<p>Password Confirm
    <input type="text" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50"/>
    <?php echo form_error('passconf'); ?></p>

<p>Email Address
    <input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50"/>
    <?php echo form_error('email'); ?></p>

<div><input type="submit" value="Submit"/></div>

</form>