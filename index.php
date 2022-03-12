<?php

include_once('db.php');


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
    echo $sql;
}


if(is_numeric($_GET['lists'])){

    $sql = "select * 
        from list l inner join items i on i.list_id = l.id
        where l.id = ". $_GET['lists'];
    $query=mysqli_query($connection,$sql);
    echo $sql;
    while ($qq=mysqli_fetch_array($query))
    {
       var_dump($qq);
       $listItemArray[] = $qq;
    }
}



?>

<form action="index.php" id="main_page">
    
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
                if(is_numeric($_GET['lists']) && $list['id'] == $_GET['lists']){
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
            ?>
            <br><input type="text" id="item_name" name="item_name" value="<?php echo $items['name'];?>">
            <?php
        }
    
    ?>
    <br>
    <input type="text" id="new_item" name="new_item" value="">
    <input type="submit" value="Add" name="btn_new_item" id="btn_new_item">
</form>
<?php
