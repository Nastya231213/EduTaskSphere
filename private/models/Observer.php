
<?php 
/**
 * @file Observer.php
 * @brief Файл містить визначення класу Observer.
*/
/**
 * @interface Observer
 * @brief Інтерфейс для реалізації спостерігачів, що надсилають сповіщення.
 *
 * Інтерфейс Observer визначає метод для надсилання сповіщень, який повинен бути реалізований усіма спостерігачами.
 */
interface Observer {
    public function sendNotification(string $message,string $title,string $type);
}
