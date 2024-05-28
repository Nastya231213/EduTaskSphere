


<?php
/**
 * @file login.php
 * @brief Контроллер, який керує процесом аутентифікації користувачів у веб-застосунку.
 */

/**
 * @class Login
 * @brief Контроллер, який керує процесом аутентифікації користувачів у веб-застосунку.
 */
class Login extends Controller
{  /**
    * Відображає сторінку входу користувача.
    * 
    * При введенні користувачем даних для входу перевіряє введені дані
    * та аутентифікує користувача. У разі успішної аутентифікації
    * перенаправляє користувача на головну сторінку. У разі невірної
    * електронної пошти або пароля виводить помилку.
    * 
    * @return void
    */
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
                    $this->redirect("home");
               
            } else {
                $errors[] = "Incorrect email or password. Please try again.";
            }
        }
        $this->view("login", ['errors' => $errors]);
    }
}
