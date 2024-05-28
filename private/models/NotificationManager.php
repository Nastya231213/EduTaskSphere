

<?php
/**
 * @file NotificationManager.php
 * @brief Файл містить визначення класу NotificationManager.
 */
/**
 * @class NotificationManager
 * @brief Клас для управління сповіщеннями та їх обробки.
 *
 * Клас NotificationManager забезпечує додавання спостерігача, надсилання сповіщень та взаємодію з моделлю бази даних для операцій зі сповіщеннями.
 */
class NotificationManager
{
    /**
     * @var Observer $observer Об'єкт спостерігача для відправки сповіщень.
     */
    private $observer;

    /**
     * @var Model $model Об'єкт моделі для роботи з базою даних.
     */
    private $model;

    /**
     * @var string $tableName Назва таблиці бази даних для сповіщень.
     */
    private $tableName = "notification";

    /**
     * @var array $typesOfNotifications Типи сповіщень.
     */
    private const typesOfNotifications = ['Alert', 'Confirmation', 'Informational'];

    /**
     * @brief Конструктор класу NotificationManager.
     */
    function __construct()
    {
        $this->model = new Model();
    }

    /**
     * @brief Додає спостерігача для відправки сповіщень.
     *
     * @param Observer $observer Об'єкт спостерігача.
     */
    public function addObserver(Observer $observer)
    {
        $this->observer = $observer;
    }

    /**
     * @brief Видаляє сповіщення за ідентифікатором.
     *
     * @param int $id Ідентифікатор сповіщення.
     * @return bool Результат виконання операції видалення (true - успіх, false - помилка).
     */
    public function deleteNotificationById($id)
    {
        return $this->model->delete($this->tableName, ['id' => $id]);
    }

    /**
     * @brief Сповіщає спостерігача про додавання учня.
     *
     * @return bool Результат виконання операції сповіщення.
     */
    public function notifyObserverAboutPupilAddition()
    {
        $teacherId = $_SESSION['user']->userId;
        $message = "Teacher $teacherId has requested to add a new pupil.";
        $title = "Pupil Addition Request";
        $type = self::typesOfNotifications[1];
        return $this->notify($message, $title, $type);
    }

    /**
     * @brief Сповіщає про прийняття запиту.
     *
     * @return bool Результат виконання операції сповіщення.
     */
    public function notifyAboutAcception()
    {
        $pupilId = $_SESSION['user']->userId;
        $message = "Pupil $pupilId has accepted the request.";
        $title = "Pupil Addition Accepted";
        return $this->notify($message, $title, self::typesOfNotifications[2]);
    }
    /**
     * @brief Приватний метод для надсилання сповіщення через спостерігача.
     *
     * @param string $message Текст сповіщення.
     * @param string $title Заголовок сповіщення.
     * @param string $type Тип сповіщення.
     * @return bool Результат виконання операції сповіщення.
     */
    private function notify($message, $title, $type)
    {
        return  $this->observer->sendNotification($message, $title, $type);
    }
    /**
     * @brief Сповіщає про відхилення запиту.
     *
     * @return bool Результат виконання операції сповіщення.
     */
    public function notifyRejection()
    {
        $pupilId = $_SESSION['user']->userId;
        $message = "Pupil $pupilId has rejected the request.";
        $title = "Pupil Rejection";
        return $this->notify($message, $title, self::typesOfNotifications[0]);
    }
    /**
     * @brief Отримує всі сповіщення для конкретного користувача.
     *
     * @param int $userId Ідентифікатор користувача.
     * @return array Масив сповіщень користувача.
     */
    public function getAllNotifications($userId)
    {
        return $this->model->select($this->tableName, ['receiver_id' => $userId]);
    }

    public function deleteNotificationOfTheTeacher($senderId)
    {
        $receiverId = $_SESSION['user']->userId;
        return $this->model->delete($this->tableName, ['receiver_id' => $receiverId, 'sender_id' => $senderId]);
    }
}
