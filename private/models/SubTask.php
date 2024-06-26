
<?php
/**
 * @file SubTask.php
 * @brief Файл містить визначення класу SubTask.
*/
/**
 * @interface SubTask
 * @brief Інтерфейс для підзавдань, який визначає основні методи для роботи зі стратегіями та питаннями.
 */
interface SubTask {
    /**
     * @brief Встановити стратегію для підзавдання.
     *
     * Цей метод встановлює стратегію, яка буде використовуватися підзавданням.
     *
     * @param mixed $strategy Стратегія для підзавдання.
     */
    public function setStrategy($strategy);

    /**
     * @brief Отримати стратегію підзавдання.
     *
     * Цей метод повертає стратегію, яка використовується підзавданням.
     *
     * @return mixed Стратегія підзавдання.
     */
    public function getStrategy();

    /**
     * @brief Встановити питання для підзавдання.
     *
     * Цей метод встановлює питання, яке буде асоційоване з підзавданням.
     *
     * @param string $question Питання для підзавдання.
     */
    public function setQuestion($question);

    /**
     * @brief Отримати питання підзавдання.
     *
     * Цей метод повертає питання, яке асоційоване з підзавданням.
     *
     * @return string Питання підзавдання.
     */
    public function getQuestion();
}