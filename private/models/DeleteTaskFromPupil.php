
<?php
/**
 * @file DeleteTaskFromPupil.php
 * @brief Файл містить визначення класу DeleteTaskFromPupil
 */
/**
 * @class DeleteTaskFromPupil
 * @brief Клас, що виконує команду видалення завдання учня.
 *
 * Клас DeleteTaskFromPupil реалізує інтерфейс Command і відповідає за видалення завдання учня з бази даних.
 */
class DeleteTaskFromPupil implements Command
{

    /**
     * @var Model $model Об'єкт моделі для роботи з базою даних.
     */
    private $model;

    /**
     * @var int $taskId Ідентифікатор завдання, яке потрібно видалити.
     */
    private $taskId;

    /**
     * @var int $pupilId Ідентифікатор учня, до якого відноситься завдання.
     */
    private $pupilId;

    /**
     * @var string $tableName Назва таблиці бази даних, в якій зберігається інформація про завдання учнів.
     */
    private $tableName = "pupilstasks";

    /**
     * @brief Конструктор класу DeleteTaskFromPupil.
     *
     * Ініціалізує об'єкт моделі для роботи з базою даних та зберігає ідентифікатори завдання та учня.
     *
     * @param int $taskId Ідентифікатор завдання, яке потрібно видалити.
     * @param int $pupilId Ідентифікатор учня, до якого відноситься завдання.
     */
    public function __construct($taskId, $pupilId)
    {
        $this->taskId = $taskId;
        $this->pupilId = $pupilId;
        $this->model = new Model();
    }

    /**
     * @brief Метод, що виконує видалення завдання учня з бази даних.
     *
     * Видаляє завдання учня з бази даних за вказаними ідентифікаторами завдання та учня.
     *
     * @return bool Результат виконання операції видалення (true - успіх, false - помилка).
     */
    public function execute()
    {

        return $this->model->delete($this->tableName, ['taskId' => $this->taskId, 'pupilId' => $this->pupilId]);
    }
}
