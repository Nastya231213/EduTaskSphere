
<?php
class TestTask implements SubTask {
    private $question;
    private $correctAnswer;
    private $strategy;
    private $choices;

    public function __construct($question, $correctAnswer,$choices) {
        $this->question = $question;
        $this->correctAnswer = $correctAnswer;
        $this->choices = $choices;

    }

    public function setStrategy($strategy) {
        $this->strategy = $strategy;
    }
    public function setQuestion($question)
    {
        $this->question=$question;
    }
    public function getQuestion()
    {
        return $this->question;
    }
}