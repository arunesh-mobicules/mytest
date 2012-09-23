<?php
echo "hello ajax";?>

<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th colspan="2">Action</th>
    </tr>

    <?php if (isset($record)): ?>
    <tr>
        <td> <?php echo $record->id;?></td>
        <td> <?php echo $record->name;?></td>
        <td> <?php echo $record->email;?></td>
        <td> <?php echo $record->gender;?></td>
        <td><a href="<?php echo site_url('/test/delete');?>?id=<?php echo $record->id;?> ">Delete</a></td>
        <td><a href="<?php echo site_url('/test/update');?>?id=<?php echo $record->id;?> ">Update</a></td>
    </tr>
    <?php endif;?>
    <br>
</table>

