


<?php

class Registration extends Controller{

    function index()
    {
        $errors=array();

        if(count($_POST)>0){
            $validator=new Validation();
            if($validator->validateUser($_POST)){
                $userModel=new UserModel();
                $_POST['date']=date("Y-m-d H:i:s");
                $_POST=$userModel->makeUserid($_POST);
                $hashedPassword=password_hash($_POST['password'],PASSWORD_DEFAULT);
                $_POST['password']=$hashedPassword;
                unset($_POST['confirmPassword']);
                $userModel->insertUser($_POST);
                $this->redirect("login");

            }
            $errors=$validator->getErrors();      
        
        }
        
        $this->view("registration",['errors'=>$errors]);
        
    }
}