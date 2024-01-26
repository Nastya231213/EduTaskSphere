
<?php
class OpenEndedTask implements SubTask {
    private $question;
    private $strategy;
    private $correctAnswer;
    private $taskId;

    public function __construct($question, $correctAnswer, $taskId) {
        $this->question = $question;
        $this->correctAnswer = $correctAnswer;
        $this->taskId = $taskId;
        $this->setStrategy(new OpenEndedStrategy());
    }

    public function setTaskId($taskId) {
        $this->taskId = $taskId;
    }

    public function getTaskId() {
        return $this->taskId;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function setCorrectAnswer($correctAnswer) {
        $this->correctAnswer = $correctAnswer;
    }

    public function getCorrectAnswer() {
        return $this->correctAnswer;
    }
    public function setStrategy($strategy) {
        $this->strategy = $strategy;
    }

    public function getStrategy() {
        return $this->strategy;
    }
}