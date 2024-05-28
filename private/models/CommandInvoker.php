
<?php

/**
 * @file CommandInvoker.php
 * @brief Файл містить визначення класу CommandInvoker.
 */

/**
 * @class CommandInvoker
 * @brief Клас для виклику команд, що реалізують інтерфейс Command.
 *
 * Клас CommandInvoker використовується для зберігання та виконання команд, що реалізують інтерфейс Command.
 */
class CommandInvoker
{
    /**
     * @var Command $command Об'єкт команди, яка буде виконуватись.
     */
    private $command;
    /**
     * @brief Встановлює команду для виконання.
     *
     * @param Command $command Команда, яка буде виконана.
     */
    public function setCommand(Command $command)
    {
        $this->command = $command;
    }

    /**
     * @brief Виконує встановлену команду.
     *
     * @return mixed Результат виконання команди.
     */
    public function executeCommand()
    {
        return $this->command->execute();
    }
}
