
<?php
/**
 * @file MultipleChoiceTask.php
 * @brief Файл містить визначення класу MultipleChoiceTask.
 */

/**
 * @class MultipleChoiceTask
 * @brief Клас для створення та управління підзавданнями типу "множинний вибір".
 *
 * Клас MultipleChoiceTask реалізує інтерфейс SubTask та забезпечує зберігання, налаштування і доступ до питань, варіантів відповідей та правильних відповідей.
 */
class MultipleChoiceTask implements SubTask
{
    /**
     * @var array $choices Варіанти відповідей на питання.
     */
    private $choices;

    /**
     * @var array $correctAnswers Правильні відповіді на питання.
     */
    private $correctAnswers;

    /**
     * @var MultipleChoiceStrategy $strategy Стратегія для обробки підзавдань типу "множинний вибір".
     */
    private $strategy;

    /**
     * @var string $question Текст питання.
     */
    private $question;

    /**
     * @var int $taskId Ідентифікатор завдання.
     */
    private $taskId;

    /**
     * @brief Конструктор класу MultipleChoiceTask.
     *
     * @param string $question Текст питання.
     * @param array $choices Варіанти відповідей.
     * @param array $correctAnswers Правильні відповіді.
     * @param int $taskId Ідентифікатор завдання.
     */
    public function __construct($question, $choices, $correctAnswers, $taskId)
    {
        $this->question = $question;
        $this->choices = $choices;
        $this->taskId = $taskId;
        $this->correctAnswers = $correctAnswers;
        $this->setStrategy(new MultipleChoiceStrategy());
    }

    /**
     * @brief Встановлює ідентифікатор завдання.
     *
     * @param int $taskId Ідентифікатор завдання.
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
    }
    /**
     * @brief Повертає ідентифікатор завдання.
     *
     * @return int Ідентифікатор завдання.
     */
    public function getTaskId()
    {
        return $this->taskId;
    }
    /**
     * @brief Встановлює варіанти відповідей на питання.
     *
     * @param array $choices Варіанти відповідей.
     */
    public function setChoices($choices)
    {
        $this->taskId = $choices;
    }
    /**
     * @brief Повертає варіанти відповідей на питання.
     *
     * @return array Варіанти відповідей.
     */
    public function getChoices()
    {
        return $this->choices;
    }
    /**
     * @brief Встановлює текст питання.
     *
     * @param string $question Текст питання.
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }
    /**
     * @brief Повертає текст питання.
     *
     * @return string Текст питання.
     */
    public function getQuestion()
    {
        return $this->question;
    }
    /**
     * @brief Встановлює правильні відповіді на питання.
     *
     * @param array $correctAnswers Правильні відповіді.
     */
    public function setCorrectAnswers($correctAnswers)
    {
        $this->correctAnswers = $correctAnswers;
    }
   /**
     * @brief Повертає правильні відповіді на питання.
     *
     * @return array Правильні відповіді.
     */
    public function getCorrectAnswers()
    {
        return $this->correctAnswers;
    }
        /**
     * @brief Встановлює стратегію для обробки підзавдань типу "множинний вибір".
     *
     * @param MultipleChoiceStrategy $strategy Стратегія для обробки підзавдань.
     */
    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
    }

    public function getStrategy()
    {
        return $this->strategy;
    }
}
