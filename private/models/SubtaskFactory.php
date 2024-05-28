<?php

/**
 * @file SubtaskFactory.php
 * @brief Файл містить визначення класу SubtaskFactory.
*/
/**
 * @interface SubtaskFactory
 * @brief Інтерфейс для фабрики підзавдань, який визначає методи створення різних типів підзавдань.
 */
interface SubtaskFactory {
    /**
     * @brief Створити тестове завдання.
     *
     * Цей метод створює тестове завдання з вказаним питанням, правильними відповідями та виборами.
     *
     * @param string $question Питання для тестового завдання.
     * @param string $correctAnswer Правильна відповідь для тестового завдання.
     * @param array $choices Вибори для тестового завдання.
     * @param string $taskId Ідентифікатор завдання.
     * @return SubTask Створене тестове завдання.
     */
    public function createTestTask($question, $correctAnswer, $choices, $taskId): SubTask;

    /**
     * @brief Створити завдання з відкритою відповіддю.
     *
     * Цей метод створює завдання з відкритою відповіддю з вказаним питанням і правильною відповіддю.
     *
     * @param string $question Питання для завдання з відкритою відповіддю.
     * @param string $correctAnswer Правильна відповідь для завдання з відкритою відповіддю.
     * @param string $taskId Ідентифікатор завдання.
     * @return SubTask Створене завдання з відкритою відповіддю.
     */
    public function createOpenEndedTask($question, $correctAnswer, $taskId): SubTask;

    /**
     * @brief Створити завдання з множинним вибором.
     *
     * Цей метод створює завдання з множинним вибором з вказаним питанням, виборами та правильними відповідями.
     *
     * @param string $question Питання для завдання з множинним вибором.
     * @param array $choices Вибори для завдання з множинним вибором.
     * @param array $correctAnswers Правильні відповіді для завдання з множинним вибором.
     * @param string $taskId Ідентифікатор завдання.
     * @return SubTask Створене завдання з множинним вибором.
     */
    public function createMultipleChoiceTask($question, $choices, $correctAnswers, $taskId): SubTask;
}