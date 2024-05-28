

<?php
/**
 * @file notification.php
 * @brief Клас, який керує процесом обробки повідомлень користувача.
 */
/**
 * @class Notification
 * @brief Контролер для обробки повідомлень користувача.
 */
class Notification extends Controller
{
    /**
     * @brief Основний метод для контролера Notification.
     *
     * Цей метод викликається при доступі до контролера Notification. Він виконує наступні дії:
     * - Якщо у сесії є повідомлення про успіх або помилку, додає їх до даних для відображення і видаляє з сесії.
     * - Відображає сторінку з усіма повідомленнями.
     * @return void
     */
    function index()
    {
        $notificationManager = new NotificationManager();
        $currentUserId = $_SESSION['user']->userId;
        $data['allNotifications'] = $notificationManager->getAllNotifications($currentUserId);
        if (isset($_SESSION['messageSuccess'])) {
            $data['messageSuccess'] = $_SESSION['messageSuccess'];
            unset($_SESSION['messageSuccess']);
        } else if (isset($_SESSION['messageError'])) {
            $data['messageError'] = $_SESSION['messageError'];
            unset($_SESSION['messageError']);
        }

        $this->view("notifications", $data);
    }
    /**
     * @brief Метод для прийняття запиту.
     *
     * Цей метод викликається для прийняття запиту. Він виконує наступні дії:
     * - Отримує ідентифікатор поточного користувача із сесії.
     * - Приймає запит і видаляє відповідне повідомлення.
     * - Додає нового спостерігача і надсилає повідомлення про прийняття.
     * - Додає повідомлення про успіх або помилку до сесії.
     * - Перенаправляє на сторінку повідомлень.
     *
     * @param int $id Ідентифікатор запиту.
     * @return void
     */
    function accept($id)
    {
        $receiverId = $_SESSION['user']->userId;
        $notificationManager = new NotificationManager();

        $userObserver = new User($receiverId);
        if ($userObserver->acceptRequest($id) && $notificationManager->deleteNotificationOfTheTeacher($id)) {
            $user = new User($id);
            $notificationManager->addObserver($user);
            $notificationManager->notifyAboutAcception();
            $_SESSION['messageSuccess'] = "The request was accepted!";
        } else {
            $_SESSION['messageError'] = "Something goes wrong";
        }
        $this->redirect("notification");
    }
    /**
     * @brief Метод для видалення повідомлення.
     *
     * Цей метод викликається для видалення повідомлення за його ідентифікатором.
     * Він виконує наступні дії:
     * - Видаляє повідомлення за його ідентифікатором.
     * - Перенаправляє на сторінку повідомлень.
     *
     * @param int $notificId Ідентифікатор повідомлення.
     * @return void
     */
    function delete($notificId)
    {
        $notificationManager = new NotificationManager();
        $notificationManager->deleteNotificationById($notificId);
        $this->redirect('notification');
    }
}
