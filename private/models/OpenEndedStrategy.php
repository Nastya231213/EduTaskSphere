<?php

class OpenEndedStrategy implements SubTaskStrategy
{
    private $model;
    private $error;
    private $subtaskType = 'open-ended-question';
    public function evaluateAnswer($userAnswer, $correctAnswer)
    {
    }
    public function addToDatabase($openEndedQuestion)
    {
        if($openEndedQuestion instanceof OpenEndedTask){
            $this->model=new Model();
            $data['question']=$openEndedQuestion->getQuestion();
            $data['correctAnswer']=$openEndedQuestion->getCorrectAnswer();
            $data['taskId']=$openEndedQuestion->getTaskId();
            $data['subtaskType']=$this->subtaskType;

            $data['subtaskId']=randomString();
            $table="subtask";
            $this->model->insert($table,$data);
        }
       
        
    }
}
