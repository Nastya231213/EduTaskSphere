<?php

/**
 * @file DeadlineFilter.php
 * @brief Файл, що містить клас DeadlineFilter для фільтрації завдань за дедлайном.
 */

/**
 * @class DeadlineFilter
 * @brief Клас для фільтрації завдань за дедлайном.
 *
 * Клас DeadlineFilter реалізує інтерфейс Interpreter і забезпечує можливість фільтрації завдань за дедлайном.
 */
class DeadlineFilter implements Interpreter
{
    /**
     * @var mixed $deadline Дедлайн для фільтрації завдань.
     */
    private $deadline;
    /**
     * @brief Конструктор класу DeadlineFilter.
     *
     * @param mixed $deadline Дедлайн для фільтрації завдань.
     */
    public function __construct($deadline)
    {
        $this->deadline = $deadline;
    }
    /**
     * @brief Метод для інтерпретації фільтрації за дедлайном.
     *
     * @param array $tasks Масив завдань, які потрібно фільтрувати.
     * @return array Масив завдань, які задовольняють умові дедлайну.
     *
     * @throws InvalidArgumentException Якщо переданий масив завдань недійсний або порожній.
     */
    public function interpret($tasks)
    {
        if (!is_array($tasks) || empty($tasks)) {
            throw new InvalidArgumentException('Invalid tasks array.');
        }


        return array_filter($tasks, function ($task) {
            return $task->deadline <= $this->deadline;
        });
    }
}
