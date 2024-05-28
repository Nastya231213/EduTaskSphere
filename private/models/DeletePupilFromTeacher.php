

<?php

/**
 * @file DeletePupilFromTeacher.php
 * @brief Файл, що містить клас DeletePupilFromTeacher для видалення учня зі списку вчителів.
 */

/**
 * @class DeletePupilFromTeacher
 * @brief Клас, що виконує команду видалення учня зі списку вчителів.
 *
 * Клас DeletePupilFromTeacher реалізує інтерфейс Command і відповідає за видалення учня зі списку вчителів у базі даних.
 */
class DeletePupilFromTeacher implements Command
{
    /**
     * @var Model $model Об'єкт моделі для роботи з базою даних.
     */
    private $model;

    /**
     * @var array $conditions Умови для видалення учня зі списку вчителів.
     */
    private $conditions;

    /**
     * @var string $tableName Назва таблиці бази даних, в якій зберігається відношення вчителів та учнів.
     */
    private $tableName = "teacher_pupil_relation";

    /**
     * @brief Конструктор класу DeletePupilFromTeacher.
     *
     * @param array $conditions Умови для видалення учня зі списку вчителів.
     */

    public function __construct($conditions)
    {
        $this->model = new Model();
        $this->conditions = $conditions;
    }
    /**
     * @brief Метод, що виконує видалення учня зі списку вчителів у базі даних.
     *
     * @return bool Результат виконання операції видалення (true - успіх, false - помилка).
     */
    public function execute()
    {
        return $this->model->delete($this->tableName, $this->conditions);
    }
}
