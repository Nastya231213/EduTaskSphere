


<?php 

class Logout extends Controller{

    function index(){
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
        }
        $this->redirect("login");
    }
}