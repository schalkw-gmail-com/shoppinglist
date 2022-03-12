<?php
 
class dbConnection{

    public $connection;
    public function __construct()
    {
        $this->connection = mysqli_connect("127.0.0.1", "root", "kickstart", "shopping");

        if (!$this->connection) {
            die("cannot connect to server");
        }
    }
 
    function select_all_list(){
        $theListArray = array();
        $sql = "select * from list";
        $query = mysqli_query($this->connection, $sql);

        while ($qq = mysqli_fetch_array($query)) {
            $theListArray[] = $qq;
        }
        return $theListArray;
    }
    
    function add_new_list($name){
        $sql = "insert into list (name) values ('" . $name . "')";
        $query = mysqli_query($this->connection, $sql);
    }
    
    function select_all_items_per_list($listId){
        $sql = "select * from items where list_id = ".$listId;
        $listItemArray = array();
        $query = mysqli_query($this->connection, $sql);

        while ($qq = mysqli_fetch_array($query)) {
            $listItemArray[] = $qq;
        }
        
        return $listItemArray;        
    }
    
    function remove_item_from_list($listId,$itemId){
        $sql = "delete from items where id = " .$itemId. " and list_id =".$listId;
        $query = mysqli_query($this->connection, $sql);
    }
    
    function edit_item_in_list($value, $listId, $itemId){
        $sql = "update items set name = '" . $value . "' where id = " . $itemId . " and list_id = " . $listId;
        $query = mysqli_query($this->connection, $sql);
    }

        
    public function add_new_item_to_list($value, $listId){
        $sql = "insert into items (name, list_id) values ('" . $value . "', " . $listId . ")";
        $query = mysqli_query($this->connection, $sql);
    }
    
    public function mark_items_on_list($listId, $idString){
        $sql = "update items set checked = 1 where list_id = " . $listId . " and id in (" . $idString . ")";
        $query = mysqli_query($this->connection, $sql);
    }
    
    public function un_mark_all_items_on_list($listId){
        $sql = "update items set checked = 0 where list_id = " . $listId;
        $query = mysqli_query($this->connection, $sql);
    }


}
$db = new dbConnection();
