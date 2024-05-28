<?php
/**
 * @file SearchKeyFilter.php
 * @brief Файл містить визначення класу SearchKeyFilter.
*/
/**
 * @class SearchKeyFilter
 * @brief Клас фільтрації завдань за ключем пошуку.
 *
 * Клас SearchKeyFilter реалізує інтерфейс Interpreter і дозволяє фільтрувати масив завдань
 * за певним ключем пошуку у заголовках та описах завдань.
 */
class SearchKeyFilter implements Interpreter {
    /**
     * @var string $searchKey Ключ пошуку для фільтрації завдань.
     */
    private $searchKey;

    /**
     * @brief Конструктор класу.
     *
     * Ініціалізує об'єкт фільтра з заданим ключем пошуку.
     *
     * @param string $searchKey Ключ пошуку для фільтрації завдань.
     */
    public function __construct($searchKey) {
        $this->searchKey = $searchKey;
    }

    /**
     * @brief Метод інтерпретації для фільтрації завдань за ключем пошуку.
     *
     * Цей метод фільтрує масив завдань за вказаним ключем пошуку у заголовках та описах завдань.
     *
     * @param array $tasks Масив завдань, який необхідно фільтрувати.
     * @return array Масив, що містить лише завдання, які відповідають ключу пошуку.
     * @throws InvalidArgumentException Якщо вхідний параметр $tasks не є масивом або порожній.
     */
    public function interpret($tasks) {
        if (!is_array($tasks) || empty($tasks)) {
            throw new InvalidArgumentException('Invalid tasks array.');
        }

        return array_filter($tasks, function($task) {
            $titleMatch = stripos(strtolower($task->title), strtolower($this->searchKey)) !== false;
            $descriptionMatch = stripos(strtolower($task->description), strtolower($this->searchKey)) !== false;
            
            return $titleMatch || $descriptionMatch;
        });
    }
}