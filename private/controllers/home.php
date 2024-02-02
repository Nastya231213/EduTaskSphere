


<?php

class Home extends Controller{

    function index()
    {
        if(!isSignIn()){
            $this->redirect('login');
        }
        $this->view("teacherHome");
        
    }
 
}