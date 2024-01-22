<?php

class App
{
    protected $currentController = "home";
    protected $method = "index";
    protected $params = array();



    
    private function getURL()
    {

        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return explode("/", filter_var(trim($url)), FILTER_SANITIZE_URL);
    }
    function __construct()
    {
        $URL = $this->getURL();
        if (file_exists("../private/controllers/".$URL[0].".php")) {
            $this->currentController = ucfirst($URL[0]);
            unset($URL[0]);
        }else{
            echo "<center><h3>controller not found</h13</center>";
            die;
        }

        require "../private/controllers/".$this->currentController.".php";
        $this->currentController=new $this->currentController();
        if(isset($URL[1])){
            if(method_exists($this->currentController,$URL[1])){
                $this->method=$URL[1];
                unset($URL[1]);
            }
        }
        $URL=array_values($URL);
        
        $this->params=$URL;
        call_user_func_array([$this->currentController,$this->method],$this->params);
    }

}
