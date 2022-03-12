<html>
<head>
    <title>
        My shopping lists
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
    <style>    
        
        #main{
            border: 1px solid black;
            margin-top: 10px;
        }
        
        .center {
            margin: auto;
            width: 50%;         
            padding: 10px;
        }
        
        .my-margin{
            margin:10px;
        }
    </style>
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
    <body>
        <div class="center" id="main">
