<?php
class MultipleChoiceStrategy implements SubTaskStrategy
{
    private $model;
    private $subtaskType='multiplechoice-question';

    public function evaluateAnswer($userAnswer, $correctAnswer)
    {
    }
    public function addToDatabase($multiplechoiceQuestion)
    {
        if($multiplechoiceQuestion instanceof MultipleChoiceTask){
            $this->model=new Model();
            $data['question']=$multiplechoiceQuestion->getQuestion();
            $data['taskId']=$multiplechoiceQuestion->getTaskId();
            $data['subtaskId']=randomString();
            $data['subtaskType']=$this->subtaskType;

            $table="subtask";
            $this->model->insert($table,$data);
            $choices=$multiplechoiceQuestion->getChoices();
            $correctAnswers=$multiplechoiceQuestion->getCorrectAnswers();
            $dataOption['subtaskId']=$data['subtaskId'];
            $table='test_options';
            foreach($choices as $choice){

                $dataOption['optionText']=$choice;
                if(in_array($choice,$correctAnswers)){
                    $dataOption['isCorrect']=1;
                }else{
                    $dataOption['isCorrect']=0;
                }
                $this->model->insert($table,$dataOption);

            }
        }
       
        
    }
}