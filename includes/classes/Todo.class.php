<?php 
class Todo {
    //Properties 
    private $what;
    private $toDoList;

    //Methods
    //Construct to do
    function __construct() {
        //Read JSON
        if(file_exists("todo.json")) {
            $this->toDoList = json_decode(file_get_contents("todo.json"));
        } else {
            $this->toDoList = [];
        }   
    }

    //Save todo
    public function saveTodo() : bool {
        if(isset($this->what)) {
            //Gather info
            $temp['what'] = $this->what;
            $temp['timestamp'] = date("Y-m-d H:i");
            
            //Add to array toDoList 
            array_push($this->toDoList, $temp);

            //Convert to JSON 
            $jsonData = json_encode($this->toDoList, JSON_PRETTY_PRINT);

            //Save to todo.json
            if(file_put_contents("todo.json", $jsonData)) {
                return true;
            } else {
                return false;
            } 
        } else {
            return false;
        }
    }

    //Delete todo
    public function deleteToDo(int $index) : bool {
      
        //Remove from array
        unset($this->toDoList[$index]);

        //Sort index of array
        $this->toDoList = array_values($this->toDoList);

            //Convert to JSON 
            $jsonData = json_encode($this->toDoList, JSON_PRETTY_PRINT);

            //Save to todo.json
            if(file_put_contents("todo.json", $jsonData)) {
                return true;
            } else {
                return false;
            } 
           
    }

    //Set what
    public function setWhat(string $what) : bool {
        if (strlen($what) > 4) {
            $data = trim(ucfirst($what));
            $this->what = $data;
            return true;
        } else {
            return false;
        }
    }

    //Get array of todos
    public function getToDoList() : array {
        array_values($this->toDoList);
        return $this->toDoList;
    }

    //Clear json file 
    public function clearJson() {
        $this->toDoList = [];

        //Convert to JSON 
        $jsonData = json_encode($this->toDoList, JSON_PRETTY_PRINT);

        //Save to todo.json
        if(file_put_contents("todo.json", $jsonData)) {
            return true;
        } else {
            return false;
        } 
    }
}
?>