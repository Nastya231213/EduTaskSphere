<?php
/**
 * @file  InProgressState.php
 * @brief Файл містить визначення класу InProgressState
*/
/**
 * @class InProgressState
 * @brief Клас, що реалізує стан "В процесі" для завдань учнів.
 *
 * Клас InProgressState реалізує інтерфейс TasksState і відповідає за оновлення стану завдання учня до "В процесі" в базі даних.
 */
class InProgressState implements TasksState {
    /**
     * @var string $state Стан завдання "В процесі".
     */
    private $state = "In progress";

    /**
     * @var string $tableName Назва таблиці бази даних, в якій зберігається інформація про завдання учнів.
     */
    private $tableName = "pupilstasks";

    /**
     * @brief Метод для оновлення стану завдання учня до "В процесі".
     *
     * Оновлює стан завдання учня в базі даних на "В процесі" за вказаними ідентифікаторами завдання та учня.
     *
     * @param int $taskId Ідентифікатор завдання.
     * @param int $pupilId Ідентифікатор учня.
     * @return bool Результат виконання операції оновлення (true - успіх, false - помилка).
     */
    public function updateState($taskId,$pupilId) {
       $model=new Model();
       return $model->update($this->tableName,['completionStatus'=>$this->state],['taskId'=>$taskId,'pupilId'=>$pupilId]);

    }
  
   
}