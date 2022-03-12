<?php

include_once('db.php');

var_dump($_REQUEST);
echo "<h1>wwwwwww</h1>";

$sql = "select * from list";
$query=mysqli_query($connection,$sql);
$listArray = array();
while ($qq=mysqli_fetch_array($query))
{
    $listArray[] = $qq; 
}

if($_GET['action']=='new'){
    echo "build a a  new list";
    require_once('new-list.php');
}

var_dump($_REQUEST);

if(!is_null($_REQUEST['btn_new_item'])){
    $sql = "insert into items (name, list_id) values ('".$_REQUEST['new_item']."', ".$_REQUEST['lists'].")";
    $query=mysqli_query($connection,$sql);
   // echo $sql;
}


if(is_numeric($_REQUEST['lists'])){
    
    if($_REQUEST['btn_mark_items'] == 'Mark Items'  ){
        
        $idString = implode(",",$_REQUEST['list_items']);
        $sql = "update items set checked = 1 where list_id = ".$_REQUEST['lists']." and id in (".$idString.")";
        $query=mysqli_query($connection,$sql);
    }

    $sql = "select * 
        from list l inner join items i on i.list_id = l.id
        where l.id = ". $_REQUEST['lists'];
    $query=mysqli_query($connection,$sql);
  //  echo $sql;
    while ($qq=mysqli_fetch_array($query))
    {
     //  var_dump($qq);
       $listItemArray[] = $qq;
    }
}



?>

<form action="index.php" id="main_page" method="post">
    
<a href="index.php?action=new">New List</a>

<script>
    function changeList(selectObject) {
        var value = selectObject.value;
        console.log(value);
        document.getElementById("main_page").submit();
    }
</script>
    
    <select name="lists" id="lists" onchange="changeList(this)">
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
            <input type="checkbox" name="list_items[]" id="list_items" <?php echo $checked;?> value="<?php echo $items['id'];?>"><?php echo $items['name'];?><br>
            <?php
        }
    
    ?>
    <br>
    <input type="text" id="new_item" name="new_item" value="">
    <input type="submit" value="Add" name="btn_new_item" id="btn_new_item">
    <input type="submit" value="Mark Items" name="btn_mark_items" id="btn_mark_items">
</form>
<?php
