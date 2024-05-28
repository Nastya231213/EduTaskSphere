<?php
/**
 * @file SendTaskToPupil.php
 * @brief Файл містить визначення класу SendTaskToPupil.
*/
/**
 * @class SendTaskToPupil
 * @brief Клас для відправки завдання учневі.
 *
 * Клас SendTaskToPupil реалізує інтерфейс Command і відповідає за вставку інформації
 * про надане завдання учневі до бази даних.
 */
class SendTaskToPupil implements Command{

    /**
     * @var Model $model Об'єкт моделі для виконання запитів до бази даних.
     */
    private $model;

    /**
     * @var array $taskData Дані про завдання, яке буде надіслане учневі.
     */
    private $taskData;

    /**
     * @var string $tableName Назва таблиці в базі даних, куди буде вставлено інформацію про завдання.
     */
    private $tableName = "pupilstasks";

    /**
     * @brief Конструктор класу.
     *
     * Ініціалізує об'єкт моделі та зберігає дані про завдання, яке буде надіслане учневі.
     *
     * @param array $taskData Дані про завдання для відправлення учневі.
     */
    public function __construct($taskData)
    {
        $this->model = new Model();
        $this->taskData = $taskData;
    }

    /**
     * @brief Виконати дію команди.
     *
     * Цей метод виконує вставку інформації про надане завдання учневі до бази даних.
     */
    public function execute()
    {
        $this->model->insert($this->tableName, $this->taskData);
    }
}
