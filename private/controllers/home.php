


<?php

class Home extends Controller{

    function index()
    {
        if(!isSignIn()){
            $this->redirect('login');
        }
        $typeOfUser=getUserType();
        if($typeOfUser=='teacher'){
            $this->view("teacherHome");

        }else if($typeOfUser=='pupil'){
            $this->view('home');
        }else{
            $this->view('404_page');
        }
        
    }
 
}