

<?php
/**
 * @file AddPupilToTeacher.php
 * @brief Файл містить клас AddPupilToTeacher для додавання учня до вчителя.
 */

/**
 * @class AddPupilToTeacher
 * Клас AddPupilToTeacher реалізує інтерфейс Command для додавання зв'язку
 * між вчителем та учнем у базу даних.
 */

class AddPupilToTeacher implements Command
{
    /**
     * @var Model Об'єкт класу Model для взаємодії з базою даних.
     */
    private $model;

    /**
     * @var array Дані для вставки в базу даних.
     */
    private $data;

    /**
     * @var string Назва таблиці в базі даних.
     */

    private $tableName = "teacher_pupil_relation";

    public function __construct($data)
    {
        $this->model = new Model();
        $this->data = $data;
    }
    public function execute()
    {
        $this->model->insert($this->tableName, $this->data);
    }
}
