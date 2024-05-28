<?php
/**
 * @file SubjectFilter.php
 * @brief Файл містить визначення класу SubjectFilter.
*/
/**
 * @class SubjectFilter
 * @brief Клас для фільтрації завдань за предметом.
 *
 * Клас SubjectFilter реалізує інтерфейс Interpreter і надає можливість фільтрувати завдання за заданим предметом.
 */
class SubjectFilter implements Interpreter {
    /**
     * @var string $subject Предмет, за яким здійснюється фільтрація.
     */
    private $subject;

    /**
     * @brief Конструктор класу SubjectFilter.
     *
     * Ініціалізує фільтр з вказаним предметом.
     *
     * @param string $subject Предмет для фільтрації завдань.
     */
    public function __construct($subject) {
        $this->subject = $subject;
    }

    /**
     * @brief Метод для інтерпретації та фільтрації завдань.
     *
     * Фільтрує завдання на основі заданого предмета.
     *
     * @param array $tasks Масив завдань для фільтрації.
     * @return array Відфільтрований масив завдань.
     * @throws InvalidArgumentException Якщо переданий параметр не є масивом.
     */
    public function interpret($tasks) {
        if(!is_array($tasks)){
            throw new InvalidArgumentException('Tasks must be provided as an array of tasks');
        }
        return array_filter($tasks, function($task) {
            return $task->subject === $this->subject;
        });
    }
}
