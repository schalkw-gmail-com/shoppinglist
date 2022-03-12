<?php
    include_once('db.php');

    if ($_REQUEST['save_list'] == 'save' && $_REQUEST['list_name'] != '') {
        $sql = "insert into list (name) values ('" . $_REQUEST['list_name'] . "')";
        mysqli_query($connection, $sql);
        header('location:index.php');
    }

include_once ('header.php');
?>

<h1> new list</h1>

<form action="new-list.php">
    <input type="text" id="list_name" name="list_name" value="">
    <input type="submit" value="save" name="save_list" id="save_list" class="btn btn-primary">    
</form>
<?php
include_once ('footer.php');
