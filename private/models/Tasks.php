

<?php

/**
 * @class Tasks
 * @brief Абстрактний клас для управління завданнями.
 * 
 * Цей клас є шаблоном для створення різних типів завдань та забезпечує базові методи для роботи з завданнями у базі даних.
 */
//Template method
abstract class Tasks
{
    /**
     * @var Model $model Об'єкт моделі для взаємодії з базою даних.
     */
    protected $model;

    /**
     * @var string $tableName Ім'я таблиці завдань у базі даних.
     */
    protected $tableName = "tasks";

    /**
     * @brief Абстрактний метод для додавання підзавдання.
     * 
     * Цей метод має бути реалізований у класах-нащадках.
     * 
     * @param SubTask $subtask Підзавдання для додавання.
     */
    abstract public function addSubtask(SubTask $subtask);

    /**
     * @brief Конструктор класу.
     * 
     * Ініціалізує об'єкт моделі для взаємодії з базою даних.
     */
    public function __construct()
    {
        $this->model = new Model();
    }

    /**
     * @brief Додає завдання до бази даних.
     * 
     * Цей метод вставляє новий запис у таблицю завдань з переданими параметрами.
     * 
     * @param string $description Опис завдання.
     * @param string $deadline Кінцевий термін виконання завдання.
     * @param string $subject Предмет завдання.
     * @param string $type Тип завдання.
     * @param string $title Назва завдання.
     * @param string $task_id Ідентифікатор завдання.
     * @param string $userId Ідентифікатор користувача, що створив завдання.
     */
    public function addToDatabase($description, $deadline, $subject, $type, $title, $task_id, $userId)
    {
        $data = [
            'task_id' => $task_id,
            'description' => $description,
            'title' => $title,
            'deadline' => $deadline,
            'created_at' => date("Y-m-d H:i:s"),
            'subject' => $subject,
            'type' => $type,
            'userId' => $userId
        ];

        $this->model->insert($this->tableName, $data);
    }
}
