<?php

/**
 * @file OpenEndedStrategy.php
 * @brief Файл містить визначення класу OpenEndedStrategy.
 */
/**
 * @class OpenEndedStrategy
 * @brief Клас для роботи з підзавданнями з відкритими питаннями.
 *
 * Клас OpenEndedStrategy реалізує інтерфейс SubTaskStrategy і забезпечує методи для оцінювання відповідей та додавання завдань з відкритими питаннями до бази даних.
 */
class OpenEndedStrategy implements SubTaskStrategy
{
    /**
     * @var Model $model Об'єкт моделі для роботи з базою даних.
     */
    private $model;

    /**
     * @var string $error Повідомлення про помилку.
     */
    private $error;

    /**
     * @var string $subtaskType Тип підзавдання (відкрите питання).
     */
    private $subtaskType = 'open-ended-question';
    /**
     * @brief Оцінює відповідь користувача.
     *
     * @param mixed $userAnswer Відповідь користувача.
     * @param mixed $correctAnswer Правильна відповідь.
     */
    public function evaluateAnswer($userAnswer, $correctAnswer)
    {
    }
        /**
     * @brief Додає завдання з відкритим питанням до бази даних.
     *
     * @param OpenEndedTask $openEndedQuestion Об'єкт завдання з відкритим питанням.
     */
    public function addToDatabase($openEndedQuestion)
    {
        if ($openEndedQuestion instanceof OpenEndedTask) {
            $this->model = new Model();
            $data['question'] = $openEndedQuestion->getQuestion();
            $data['correctAnswer'] = $openEndedQuestion->getCorrectAnswer();
            $data['taskId'] = $openEndedQuestion->getTaskId();
            $data['subtaskType'] = $this->subtaskType;

            $data['subtaskId'] = randomString();
            $table = "subtask";
            $this->model->insert($table, $data);
        }
    }
}
