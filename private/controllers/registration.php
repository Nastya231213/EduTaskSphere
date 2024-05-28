


<?php
/**
 * @file registration.php
 * @brief Містить клас, який керує процесом обробки реєстрації користувачів.
 */
/**
 * @class Registration
 * @brief Контролер для обробки реєстрації користувачів.
 *
 * Клас Registration розширює базовий клас Controller і відповідає за обробку реєстрації нових користувачів.
 */
class Registration extends Controller
{
    /**
     * @brief Основний метод для контролера Registration.
     *
     * Цей метод викликається при доступі до контролера Registration. Він виконує наступні дії:
     * - Перевіряє, чи є дані у $_POST.
     * - Якщо є дані, створює новий екземпляр Validation для перевірки введених даних.
     * - Якщо валідація успішна:
     *   - Створює новий екземпляр UserModel.
     *   - Додає поточну дату до даних.
     *   - Генерує унікальний ідентифікатор користувача.
     *   - Хешує пароль користувача.
     *   - Видаляє поле 'confirmPassword'.
     *   - Вставляє користувача в базу даних.
     *   - Перенаправляє на сторінку входу.
     * - Якщо валідація неуспішна, отримує помилки з валідації.
     * - Відображає сторінку реєстрації з можливими помилками.
     *
     * @return void
     */
    function index()
    {
        $errors = array();

        if (count($_POST) > 0) {
            $validator = new Validation();
            if ($validator->validateUser($_POST)) {
                $userModel = new UserModel();
                $_POST['date'] = date("Y-m-d H:i:s");
                $_POST = $userModel->makeUserid($_POST);
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $_POST['password'] = $hashedPassword;
                unset($_POST['confirmPassword']);
                $userModel->insertUser($_POST);
                $this->redirect("login");
            }

            $errors = $validator->getErrors();
        }

        $this->view("registration", ['errors' => $errors]);
    }
}
