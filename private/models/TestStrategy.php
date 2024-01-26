
<?php

class TestStrategy implements SubTaskStrategy
{
    private $model;
    private $error;
    private $subtaskType = 'test-question';


    public function evaluateAnswer($userAnswer, $correctAnswer)
    {
    }

    public function addToDatabase($test)
    {
        if ($test instanceof TestTask) {
            $model = new Model();
            $dataForSubtask['question'] = $test->getQuestion();
            $dataForSubtask['taskId'] = $test->getTaskId();
            $dataForSubtask['subtaskType'] = $this->subtaskType;
            $dataForSubtask['subtaskId'] = randomString();
            if ($model->insert('subtask', $dataForSubtask)) {
                $choices=$test->getChoices();
                $correctAnswer=$choices[$test->getCorrectAnswer()-1];
                $dataForChoice['subtaskId']=$dataForSubtask['subtaskId'];

                foreach($choices as $choice){
                    $dataForChoice['optionText'] = $choice;

                    if($correctAnswer==$choice){
                        $dataForChoice['isCorrect']=1;
                    }else{
                        $dataForChoice['isCorrect']=0;

                    }
                    $model->insert('test_options', $dataForChoice);

                }
            }
        }
        $this->error[] = "Something goes wrong..";
        return false;
    }
}
