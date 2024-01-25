
<?php 
class MultipleChoiceTask implements SubTask {
    private $choices;
    private $correctAnswers;
    private $strategy;
    private $question;

    public function __construct($question, $choices, $correctAnswers) {
        $this->question = $question;
        $this->choices = $choices;
        $this->correctAnswers = $correctAnswers;
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
