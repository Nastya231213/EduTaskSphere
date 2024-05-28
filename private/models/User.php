<?php

/**
 * @class User
 * @brief Представляє користувача системи
 */
class User implements Observer
{
    private $id; ///< Ідентифікатор користувача.
    private $model; ///< Об'єкт моделі для взаємодії з базою даних.

    /**
     * @brief Конструктор класу User.
     * 
     * Створює новий об'єкт користувача з вказаним ідентифікатором.
     * 
     * @param int $id Ідентифікатор користувача.
     */
    public function __construct($id)
    {
        $this->model = new Model();
        $this->id = $id;
    }

    /**
     * @brief Надсилає сповіщення користувачеві.
     * 
     * @param string $message Повідомлення сповіщення.
     * @param string $title Заголовок сповіщення.
     * @param string $type Тип сповіщення.
     * @return void
     */
    public function sendNotification(string $message, string $title, string $type)
    {
        $senderId = $_SESSION['user']->userId;
        $query = "INSERT INTO notification (title, message, receiver_id, type, sender_id) VALUES (:title, :message, :receiver_id, :type, :sender_id)";
        $this->model->query($query);
        $this->model->bind(':title', $title);
        $this->model->bind(':message', $message);
        $this->model->bind(':receiver_id', $this->id);
        $this->model->bind(':sender_id', $senderId);
        $this->model->bind(':type', $type);
        $this->model->execute();
    }

    /**
     * @brief Підтверджує запит на зв'язок з вчителем.
     * 
     * @param int $teacherId Ідентифікатор вчителя.
     * @return bool Логічне значення, що вказує на успішність оновлення статусу запиту.
     */
    public function acceptRequest($teacherId)
    {
        $tableName = "teacher_pupil_relation";
        $pupilId = $_SESSION['user']->userId;
        return $this->model->update($tableName, ['status' => 'accepted'], ['teacher_id' => $teacherId, 'pupil_id' => $pupilId]);
    }

    /**
     * @brief Повертає ідентифікатор користувача.
     * 
     * @return int Ідентифікатор користувача.
     */
    public function getUserId()
    {
        return $this->id;
    }
}
