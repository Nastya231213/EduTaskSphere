

<?php 
class SubTask{

    private $strategy;
    private $userAnswer;
    private $correctAnswer;


    public function __construct(SubTaskStrategy $strategy,$correctAnswer){
        $this->strategy=$strategy;
        $this->correctAnswer=$correctAnswer;
    }

    public function setUserAnswer($userAnswer){
        $this->userAnswer=$userAnswer;
    }
    public function evaluateAnswer()
    {
        return $this->strategy->evaluateAnswer($this->userAnswer, $this->correctAnswer);
    }
}