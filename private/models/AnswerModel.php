<?php

/**
 * @file AnswerModel.php
 * @brief Файл містить клас AddPupilToTeacher, що відповідає за взаємодію з таблицею "answers_of_the_pupil" в базі даних..
 */
/**
 * @class AnswerModel
 * @brief Модель для роботи з відповідями учнів.
 *
 * Клас AnswerModel відповідає за взаємодію з таблицею "answers_of_the_pupil" в базі даних.
 */
class AnswerModel
{
    /**
     * @var string $table Назва таблиці з відповідями учнів.
     */
    protected $table = 'answers_of_the_pupil';
    /**
     * @var Model $model Об'єкт моделі для виконання запитів до бази даних.
     */
    protected $model;
    /**
     * @brief Конструктор класу.
     *
     * Ініціалізує об'єкт моделі для виконання запитів до бази даних.
     */
    public function __construct()
    {
        $this->model = new Model();
    }
    /**
     * @brief Отримати відповідь за ідентифікатором підзадачі.
     *
     * Цей метод отримує відповідь учня за ідентифікатором підзадачі.
     *
     * @param int $answerId Ідентифікатор відповіді.
     * @return array Повертає масив з даними відповіді.
     */
    function getAnswerBySubtaskId($answerId)
    {
        return $this->model->selectOne($this->table, ['id' => $answerId]);
    }
}
