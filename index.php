<?php

    include_once('db.php');
    
    if ($_REQUEST['action'] == 'remove') {
        $sql = "delete from items where id = " . $_REQUEST['item_id'];
        echo $sql;
        $query = mysqli_query($connection, $sql);
    }
    
    if ($_REQUEST['action'] == 'edit_item') {
        $sql = "update items set name = '" . $_REQUEST['name_change'] . "' where id = " . $_REQUEST['current_list_item'] . " and list_id = " . $_REQUEST['current_list'];
    
        echo $sql;
        $query = mysqli_query($connection, $sql);
    }
    
    $sql = "select * from list";
    $query = mysqli_query($connection, $sql);
    $listArray = array();
    while ($qq = mysqli_fetch_array($query)) {
        $listArray[] = $qq;
    }
    
    if ($_REQUEST['action'] == 'new') {
        require_once('new-list.php');
        die();
    }
    
    if (!is_null($_REQUEST['btn_new_item'])) {
        $sql = "insert into items (name, list_id) values ('" . $_REQUEST['new_item'] . "', " . $_REQUEST['lists'] . ")";
        $query = mysqli_query($connection, $sql);
    }
       
    if (is_numeric($_REQUEST['lists'])) {
        if ($_REQUEST['btn_mark_items'] == 'Mark Items') {
            $idString = implode(",", $_REQUEST['list_items']);
            $sql = "update items set checked = 1 where list_id = " . $_REQUEST['lists'] . " and id in (" . $idString . ")";
            $query = mysqli_query($connection, $sql);
        }
    
        $sql = "select * 
            from list l inner join items i on i.list_id = l.id
            where l.id = " . $_REQUEST['lists'];
        $query = mysqli_query($connection, $sql);
        while ($qq = mysqli_fetch_array($query)) {
            $listItemArray[] = $qq;
        }
    }

    include_once ('header.php');
    
    ?>

<h1>My Shopping List</h1>

<form action="index.php" id="main_page" method="post">
    
<a href="index.php?action=new" class="btn btn-primary my-margin">Create a New List</a>

<script>
    function changeList(selectObject) {
        var value = selectObject.value;
        console.log(value);
        document.getElementById("main_page").submit();
    }
    
    function editItem(id,currentList)
    {
        var item = 'item_'+id;
        var name = document.getElementById(item).value;
        
        document.getElementById("name_change").value = name;        
        document.getElementById("current_list").value = currentList;
        document.getElementById("current_list_item").value = id;
        document.getElementById("action").value = 'edit_item';
        
        document.getElementById("main_page").submit();
                   
    }
</script>
    <h3 class=" my-margin">Select a list to edit:</h3>
    <select name="lists" id="lists" class=" my-margin" onchange="changeList(this)">
        <option value="0" >Select a list</option>
        <?php
            foreach($listArray as $list){
                $selected = "";
                if(is_numeric($_REQUEST['lists']) && $list['id'] == $_REQUEST['lists']){
                    $selected = "selected";
                }
                ?>                
                <option <?php echo $selected;?> value="<?php echo $list['id']; ?>" ><?php echo $list['name']; ?></option>
                <?php
            }
        ?>
    </select>
    
    <?php
    
        foreach ($listItemArray as $items){
            $checked= "";
            if($items['checked'] == 1){
                $checked= "checked";
            }
            ?>
            <br>
            
            <input type="checkbox" name="list_items[]" id="list_items" <?php echo $checked;?> value="<?php echo $items['id'];?>">
            <input type="text" id="item_<?php echo $items['id'];?>" name="list_item" value="<?php echo $items['name'];?>"> 
            <a onclick="editItem(<?php echo $items['id'];?>,<?php echo $_REQUEST['lists'];?>)" class="btn btn-warning">Edit the Item </a>
            <br>
            <?php
        }    
    ?>
    <br>
    <input type="text" id="new_item" name="new_item" value="">
    
    <input type="submit" value="Add Item" name="btn_new_item" id="btn_new_item"  class="btn btn-primary">
    <input type="submit" value="Mark Items" name="btn_mark_items" id="btn_mark_items" class="btn btn-primary">
    
    <input type="hidden" id="name_change" name="name_change">
    <input type="hidden" id="current_list" name="current_list">
    <input type="hidden" id="current_list_item" name="current_list_item">
    <input type="hidden" id="action" name="action">
</form>

    
<?php
include_once ('footer.php');
