<?php

    $db ='';
    include_once('db.php');

    if ($_REQUEST['action'] == 'new') {
        require_once('new-list.php');
        die();
    }    
    
    $theListArray = $db->select_all_list();

    if ($_REQUEST['action'] == 'remove') {
        $db->remove_item_from_list($_REQUEST['lists'], $_REQUEST['item_id']);
    }
    
    if ($_REQUEST['action'] == 'edit_item') {
        $db->edit_item_in_list($_REQUEST['name_change'], $_REQUEST['current_list'], $_REQUEST['current_list_item']);
    }
    
    if (!is_null($_REQUEST['btn_new_item'])) {
        $db->add_new_item_to_list($_REQUEST['new_item'], $_REQUEST['lists']);
    }

    if ($_REQUEST['btn_mark_items'] == 'Mark Items') {
        if (is_array($_REQUEST['list_items'])) {
            $idString = implode(",", $_REQUEST['list_items']);
            $db->mark_items_on_list($_REQUEST['lists'], $idString);
        } else {
            $db->un_mark_all_items_on_list($_REQUEST['lists']);
        }
    }


//        $sql = "select * 
//            from list l inner join items i on i.list_id = l.id
//            where l.id = " . $_REQUEST['lists'];
//        $query = mysqli_query($connection, $sql);
//        while ($qq = mysqli_fetch_array($query)) {
//            $listItemArray[] = $qq;
//        }
//    }

    include_once ('header.php');
    
    ?>

<h1 class="center">My Shopping Lists</h1>

<form action="index.php" id="main_page" method="post">
    <div class=" my-margin">
        <a href="index.php?action=new" class="btn btn-primary my-margin">Create a New List</a>       
        
        Select a list to edit:
        <select name="lists" id="lists" class=" my-margin" onchange="changeList(this)">
            <option value="0" >Select a list</option>
                <?php
                    foreach($theListArray as $list){
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
    </div>
    
    <?php
        $listItemArray = $db->select_all_items_per_list($_REQUEST['lists']);
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
            <a href="index.php?action=remove&lists=<?php echo $_REQUEST['lists'];?>&item_id=<?php echo $items['id'];?>"  class="btn btn-danger">Remove Item</a>
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
