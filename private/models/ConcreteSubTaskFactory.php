
<?php

/**
 * @file ConcreteSubTaskFactory.php
 * @brief Файл містить визначення класу ConcreteSubTaskFactory
 */
/**
 * @class ConcreteSubTaskFactory
 * @brief Клас для створення різних типів підзавдань.
 *
 * Клас ConcreteSubTaskFactory реалізує інтерфейс SubTaskFactory і забезпечує методи для створення тестових завдань, завдань з відкритими питаннями та завдань з множинним вибором.
 */
class ConcreteSubTaskFactory implements SubTaskFactory
{
    /**
     * @brief Створює тестове завдання.
     *
     * @param string $question Питання тестового завдання.
     * @param string $correctAnswer Правильна відповідь на питання.
     * @param array $choices Варіанти відповідей.
     * @param int $taskId Ідентифікатор завдання.
     * @return TestSubtask Створене тестове підзавдання.
     */
    public function createTestTask($question, $correctAnswer, $choices, $taskId): TestSubtask
    {
        return new TestSubtask($question, $correctAnswer, $choices, $taskId);
    }

    /**
     * @brief Створює завдання з відкритим питанням.
     *
     * @param string $question Питання завдання.
     * @param string $correctAnswer Правильна відповідь на питання.
     * @param int $taskId Ідентифікатор завдання.
     * @return SubTask Створене підзавдання з відкритим питанням.
     */
    public function createOpenEndedTask($question, $correctAnswer, $taskId): SubTask
    {
        return new OpenEndedTask($question, $correctAnswer, $taskId);
    }
    /**
     * @brief Створює завдання з множинним вибором.
     *
     * @param string $question Питання завдання.
     * @param array $choices Варіанти відповідей.
     * @param array $correctAnswers Правильні відповіді.
     * @param int $taskId Ідентифікатор завдання.
     * @return SubTask Створене підзавдання з множинним вибором.
     */
    public function createMultipleChoiceTask($question, $choices, $correctAnswers, $taskId): SubTask
    {
        return new MultipleChoiceTask($question, $choices, $correctAnswers, $taskId);
    }
}
