<?php

/**
 * @interface Interpreter
 * @brief Інтерфейс для фільтрації та обробки завдань.
 *
 * Інтерфейс Interpreter визначає метод для фільтрації та обробки масиву завдань.
 */
interface Interpreter
{
    /**
     * @brief Метод для інтерпретації та фільтрації завдань.
     *
     * Цей метод приймає масив завдань і повертає відфільтрований масив відповідно до певних умов.
     *
     * @param array $tasks Масив завдань для фільтрації.
     * @return array Відфільтрований масив завдань.
     */
    public function interpret($tasks);
}
