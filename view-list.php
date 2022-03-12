<?php

    include_once('db.php');

    if ($_REQUEST['action'] == 'view' && is_numeric($_REQUEST['lists'])) {
        $list = $db->select_list($_REQUEST['lists']);
    }else{
        header("Location: index.php");
    }
 
    include_once('header.php');
?>

    <h1><?php echo $list[0]['name'];?></h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">checked</th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach($list as $array){
            ?>
            <tr>
                <th scope="row"><?php echo $array['id'] ?></th>
                <td><?php echo $array['item_name'] ?></td>
                <td><?php if($array['checked'] == '1'){echo "yes";} ?></td>
            </tr>
            <?php
            }            
        ?>      
        </tbody>
    </table>
    <a href="index.php?action=edit&lists=<?php echo $_REQUEST['lists'];?>"  class="btn btn-info">Go Back</a>
<?php
include_once('footer.php');
