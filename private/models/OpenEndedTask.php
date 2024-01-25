
<?php
class OpenEndedTask implements SubTask {
    private $question;
    private $strategy;
    private $correctAnswers;

    public function __construct($question,$correctAnswer) {
        $this->question = $question;

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