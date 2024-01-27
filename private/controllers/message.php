<?php


class Message extends Controller
{
    public function index()
    {
       
        $message=isset($_SESSION['message'])?$_SESSION['message']:'';
        if(isset($_SESSION['message'])){
            unset($_SESSION['message']);
        }
        
     
        $this->view("messagePage", ['message'=>$message]);
    }
}
