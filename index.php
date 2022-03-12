<?php

include_once('db.php');


echo "<h1>wwwwwww</h1>";

$sql = "select * from list";
$query=mysqli_query($connection,$sql);
while ($qq=mysqli_fetch_array($query))
{
    var_dump($qq);
}
