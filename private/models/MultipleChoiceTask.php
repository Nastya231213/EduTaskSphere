
<?php 
class MultipleChoiceTask implements SubTask {
    private $choices;
    private $correctAnswers;
    private $strategy;
    private $question;
    private $taskId;

    public function __construct($question, $choices, $correctAnswers,$taskId) {
        $this->question = $question;
        $this->choices = $choices;
        $this->taskId=$taskId;
        $this->correctAnswers = $correctAnswers;
        $this->setStrategy(new MultipleChoiceStrategy());
    }

    public function setTaskId($taskId) {
        $this->taskId = $taskId;
    }

    public function getTaskId() {
        return $this->taskId;
    }
    public function setChoices($choices) {
        $this->taskId = $choices;
    }

    public function getChoices() {
        return $this->choices;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function setCorrectAnswers($correctAnswers) {
        $this->correctAnswers = $correctAnswers;
    }

    public function getCorrectAnswers() {
        return $this->correctAnswers;
    }
    public function setStrategy($strategy) {
        $this->strategy = $strategy;
    }

    public function getStrategy() {
        return $this->strategy;
    }
}
