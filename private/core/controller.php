<?php



class Controller{
    function view($view,$data=array())
    {
        extract($data);

        if(file_exists("../private/views/".$view.".view.php")){
            require "../private/views/".$view.".view.php";
        }else{
            require "../private/views/404.view.php";
        }
    }

    public function redirect($link){
        header("Location: ".ROOT. "/".trim($link,"/"));
    }
}