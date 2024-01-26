
<?php
class TestTask implements SubTask {
    private $question;
    private $correctAnswer;
    private $strategy;
    private $choices;
    private $taskId;

    public function __construct($question, $correctAnswer,$choices,$taskId) {
        $this->question = $question;
        $this->correctAnswer = $correctAnswer;
        $this->choices = $choices;
        $this->taskId=$taskId;
        $this->setStrategy(new TestStrategy());

    }

    public function setStrategy($strategy) {
        $this->strategy = $strategy;
    }
    public function getStrategy() {
        return $this->strategy;
    }
    
    public function setTaskId($taskId) {
        $this->taskId = $taskId;
    }
    public function getTaskId() {
        return $this->taskId;
    }
    public function setQuestion($question)
    {
        $this->question=$question;
    }
    public function getQuestion()
    {
        return $this->question;
    }
    public function setCorrectAnswer($correctAnswer)
    {
        $this->correctAnswer=$correctAnswer;
    }
    public function getCorrectAnswer()
    {
        return $this->correctAnswer;
    }
    public function setChoices($choices)
    {
        $this->choices=$choices;
    }
    public function getChoices()
    {
        return $this->choices;
    }

}