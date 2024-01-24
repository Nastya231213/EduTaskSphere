

<?php 

class Task extends Controller{

    function index(){


        $this->view("create task");
    }
    
    function add(){

        if(count($_POST)>0){
            
        }
        $this->view('createTask');
    }
}