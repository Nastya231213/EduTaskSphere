<?php
/**
 * @file message.php
 * @brief Контроллер, який керує процесом аутентифікації користувачів у веб-застосунку.
 */
/**
 * @class Message
 * @brief Контролер для відображення повідомлень.
 *
 */

class Message extends Controller
{    /**
    * @brief Основний метод для контролера Message.
    *
    * Цей метод викликається при доступі до контролера Message. Він виконує наступні дії:
    * - Якщо повідомлення існує, зберігає його у змінну та видаляє з сесії.
    * - Відображає сторінку з повідомленням.
    *
    * @return void
    */
    public function index()
    {
       
        $message=isset($_SESSION['message'])?$_SESSION['message']:'';
        if(isset($_SESSION['message'])){
            unset($_SESSION['message']);
        }
        
     
        $this->view("messagePage", ['message'=>$message]);
    }
}
