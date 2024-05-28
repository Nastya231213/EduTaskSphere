
<?php
/**
 * @file OpenEndedTask.php
 * @brief Файл містить визначення класу OpenEndedTask.
*/
/**
 * @class OpenEndedTask
 * @brief Клас, що представляє підзавдання з відкритим питанням.
 *
 * Клас OpenEndedTask реалізує інтерфейс SubTask і забезпечує методи для управління завданням з відкритим питанням, включаючи встановлення та отримання питань, правильних відповідей та стратегії.
 */
class OpenEndedTask implements SubTask {
    /**
     * @var string $question Питання підзавдання.
     */
    private $question;

    /**
     * @var strategy $strategy Стратегія для оцінювання відповідей та додавання до бази даних.
     */
    private $strategy;

    /**
     * @var string $correctAnswer Правильна відповідь на питання.
     */
    private $correctAnswer;

    /**
     * @var int $taskId Ідентифікатор завдання.
     */
    private $taskId;

    /**
     * @brief Конструктор класу OpenEndedTask.
     *
     * @param string $question Питання підзавдання.
     * @param string $correctAnswer Правильна відповідь на питання.
     * @param int $taskId Ідентифікатор завдання.
     */
    public function __construct($question, $correctAnswer, $taskId) {
        $this->question = $question;
        $this->correctAnswer = $correctAnswer;
        $this->taskId = $taskId;
        $this->setStrategy(new OpenEndedStrategy());
    }

    /**
     * @brief Встановлює ідентифікатор завдання.
     *
     * @param int $taskId Ідентифікатор завдання.
     */
    public function setTaskId($taskId) {
        $this->taskId = $taskId;
    }

    /**
     * @brief Отримує ідентифікатор завдання.
     *
     * @return int Ідентифікатор завдання.
     */
    public function getTaskId() {
        return $this->taskId;
    }

    /**
     * @brief Встановлює питання підзавдання.
     *
     * @param string $question Питання підзавдання.
     */
    public function setQuestion($question) {
        $this->question = $question;
    }

    /**
     * @brief Отримує питання підзавдання.
     *
     * @return string Питання підзавдання.
     */
    public function getQuestion() {
        return $this->question;
    }

    /**
     * @brief Встановлює правильну відповідь на питання.
     *
     * @param string $correctAnswer Правильна відповідь на питання.
     */
    public function setCorrectAnswer($correctAnswer) {
        $this->correctAnswer = $correctAnswer;
    }

    /**
     * @brief Отримує правильну відповідь на питання.
     *
     * @return string Правильна відповідь на питання.
     */
    public function getCorrectAnswer() {
        return $this->correctAnswer;
    }

    /**
     * @brief Встановлює стратегію для підзавдання.
     *
     * @param OpenEndedStrategy $strategy Стратегія для підзавдання.
     */
    public function setStrategy($strategy) {
        $this->strategy = $strategy;
    }

    /**
     * @brief Отримує стратегію для підзавдання.
     *
     * @return OpenEndedStrategy Стратегія для підзавдання.
     */
    public function getStrategy() {
        return $this->strategy;
    }

}