<?php 
$page_title = "Att göra lista";
include("includes/header.php");
//Declare empty variables 
$message = ""; 
?>

<h2>Att göra</h2>
  
<div id="whiteboard">

<?php
//Instance of class
$thing = new Todo();

//Delete todo if index is set
if(isset($_GET['index'])) {
    //Store index as an int
    $index = intval($_GET['index']);

    //Call delete method
    $thing->deleteToDo($index);

    //Clear header so nothing gets removed accidentaly
    header("Location: index.php");
}

//Retrieve array in todo.json
$todos = $thing->getToDoList();

//Set index as zero before loop
$index = 0;

//Loop through and print out array
foreach($todos as $todo) { ?>
        <div class="item">
               <p class="item-name"><?= $todo->what; ?></p>
                <div class="item-data">
                    <span class="item-timestamp"><?= $todo->timestamp; ?></span>
                    <a href="index.php?index=<?= $index; ?>" class="done-btn">Klar</a>
                </div>    
        </div>

<?php 
//Increment index through each iteration
$index++;
} ?>

</div>

<!--Form where user inputs todo-->
<form class="item-add" action="add.php" method="post">
    <input class="input" type="text" name="name" placeholder="Vad har du på agendan?" autocomplete="off" required>
    <input class="submit-btn" type="submit" value="Lägg till">
</form>

<?php 
//Clear json file if y is set from clear button
if(isset($_GET['y'])) {
    //Call clear method
    $thing->clearJson();
    header("Location: index.php");
}

?>

<!--Clear button-->
<a href="index.php?y=1" id="clear-btn">Rensa listan</a>

<!--Link to json file-->
<a href="todo.json" id="json-link">JSON-fil</a>

<?php
if (isset($_GET['x'])) { 
$message = "Din påminnelse måste vara längre än fyra karaktärer";
echo "<span class='error-msg'>" . $message . "</span>";
}

?>

<?php 
include("includes/footer.php");
?>