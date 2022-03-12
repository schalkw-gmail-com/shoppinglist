<?php

include_once('db.php');


echo "<h1>wwwwwww</h1>";

$sql = "select * from list";
$query=mysqli_query($connection,$sql);
while ($qq=mysqli_fetch_array($query))
{
    
}

if($_GET['action']=='new'){
    echo "build a a  new list";
    require_once('new-list.php');
    
}

?>
<a href="index.php?action=new">New List</a>
<?php
