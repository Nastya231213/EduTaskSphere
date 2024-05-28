
<?php

/**
 * @class TestSubtask
 * @brief Представляє тестову підзадачу.
 */
class TestSubtask implements SubTask {
    private $question; ///< Текст тестового питання.
    private $correctAnswer; ///< Правильна відповідь на тестове питання.
    private $strategy; ///< Об'єкт стратегії для обробки відповіді.
    private $choices; ///< Масив варіантів відповідей на тестове питання.
    private $taskId; ///< Ідентифікатор завдання, до якого належить підзадача.

    /**
     * @brief Конструктор класу TestSubtask.
     * 
     * Створює новий об'єкт тестової підзадачі з заданими параметрами.
     * 
     * @param string $question Текст тестового питання.
     * @param string $correctAnswer Правильна відповідь на тестове питання.
     * @param array $choices Масив варіантів відповідей на тестове питання.
     * @param string $taskId Ідентифікатор завдання, до якого належить підзадача.
     */
    public function __construct($question, $correctAnswer, $choices, $taskId) {
        $this->question = $question;
        $this->correctAnswer = $correctAnswer;
        $this->choices = $choices;
        $this->taskId = $taskId;
        $this->setStrategy(new TestStrategy());
    }

    /**
     * @brief Встановлює стратегію обробки відповіді.
     * 
     * @param SubTaskStrategy $strategy Об'єкт стратегії для обробки відповіді.
     * @return void
     */
    public function setStrategy($strategy) {
        $this->strategy = $strategy;
    }

    /**
     * @brief Повертає поточну стратегію обробки відповіді.
     * 
     * @return SubTaskStrategy Об'єкт стратегії для обробки відповіді.
     */
    public function getStrategy() {
        return $this->strategy;
    }
    
    /**
     * @brief Встановлює ідентифікатор завдання, до якого належить підзадача.
     * 
     * @param string $taskId Ідентифікатор завдання.
     * @return void
     */
    public function setTaskId($taskId) {
        $this->taskId = $taskId;
    }

    /**
     * @brief Повертає ідентифікатор завдання, до якого належить підзадача.
     * 
     * @return string Ідентифікатор завдання.
     */
    public function getTaskId() {
        return $this->taskId;
    }

    /**
     * @brief Встановлює текст тестового питання.
     * 
     * @param string $question Текст тестового питання.
     * @return void
     */
    public function setQuestion($question) {
        $this->question = $question;
    }

    /**
     * @brief Повертає текст тестового питання.
     * 
     * @return string Текст тестового питання.
     */
    public function getQuestion() {
        return $this->question;
    }

    /**
     * @brief Встановлює правильну відповідь на тестове питання.
     * 
     * @param string $correctAnswer Правильна відповідь на тестове питання.
     * @return void
     */
    public function setCorrectAnswer($correctAnswer) {
        $this->correctAnswer = $correctAnswer;
    }

    /**
     * @brief Повертає правильну відповідь на тестове питання.
     * 
     * @return string Правильна відповідь на тестове питання.
     */
    public function getCorrectAnswer() {
        return $this->correctAnswer;
    }

    /**
     * @brief Встановлює варіанти відповідей на тестове питання.
     * 
     * @param array $choices Масив варіантів відповідей.
     * @return void
     */
    public function setChoices($choices) {
        $this->choices = $choices;
    }

    /**
     * @brief Повертає варіанти відповідей на тестове питання.
     * 
     * @return array Масив варіантів відповідей.
     */
    public function getChoices() {
        return $this->choices;
    }
}