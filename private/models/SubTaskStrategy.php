<?php 
/**
 * @file SubTaskStrategy.php
 * @brief Файл містить визначення класу SubTaskStrategy.
*/
/**
 * @interface SubTaskStrategy
 * @brief Інтерфейс для стратегії підзавдань, який визначає методи оцінювання відповідей та додавання підзавдань до бази даних.
 */
interface SubTaskStrategy {
    /**
     * @brief Оцінити відповідь користувача.
     *
     * Цей метод оцінює відповідь користувача на основі правильної відповіді.
     *
     * @param mixed $userAnswer Відповідь користувача.
     * @param mixed $correctAnswer Правильна відповідь.
     * @return mixed Результат оцінювання відповіді.
     */
    public function evaluateAnswer($userAnswer, $correctAnswer);

    /**
     * @brief Додати підзавдання до бази даних.
     *
     * Цей метод додає підзавдання до бази даних.
     *
     * @param SubTask $subTask Підзавдання, яке необхідно додати до бази даних.
     */
    public function addToDatabase(SubTask $subTask);
}