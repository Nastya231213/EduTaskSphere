


<?php

class Login extends Controller
{
    public function index()
    {
        $errors = array();

        if (count($_POST) > 0) {


            $userModel = new UserModel();
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userWithCurrentEmail = $userModel->findUserByEmail($email);
            if ($userWithCurrentEmail && password_verify($password, $userWithCurrentEmail->password)) {
                $_SESSION['user'] = $userWithCurrentEmail;
                //if ($userWithCurrentEmail->role == 'teacher') {
                    $this->redirect("home");
                //}
            } else {
                $errors[] = "Incorrect email or password. Please try again.";
            }
        }
        $this->view("login", ['errors' => $errors]);
    }
}
