<?php



/**
 * @file  controller.php
 * @brief Файл містить визначення класу Controller
 */
/**
 * @class Controller
 *
 * @brief Базовий клас для всіх контролерів, що забезпечує методи для відображення представлень і перенаправлення.
 */
class Controller {

    /**
     * Відображає вказане представлення з переданими даними.
     *
     * @param string $view Ім'я представлення для відображення.
     * @param array $data Дані, які будуть доступні у представленні. За замовчуванням порожній масив.
     */
    function view($view, $data = array()) {
        extract($data);

        if (file_exists("../private/views/" . $view . ".view.php")) {
            require "../private/views/" . $view . ".view.php";
        } else {
            require "../private/views/404.view.php";
        }
    }

    /**
     * Перенаправляє на вказаний URL.
     *
     * @param string $link URL для перенаправлення.
     */
    public function redirect($link) {
        header("Location: " . ROOT . "/" . trim($link, "/"));
    }
}
?>
