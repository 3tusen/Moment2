<?php 

include("includes/classes/Todo.class.php");

$what = "";



//Get form
    if (isset($_POST['name'])) {
        //Create instance of class
        $do = new Todo();

        //Gather data
        $what = $_POST['name'];

        //Check input
        if(!$do->setWhat($what)) {
            header("Location: index.php?x=1");
        } else {
            $do->setWhat($what);
            $do->saveToDo();
            header("Location: index.php");
        }

        
    }
?>
