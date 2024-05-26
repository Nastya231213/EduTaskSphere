<?php

class TaskModel extends Model
{
    private $tableName = 'tasks';
    private $tableNameOfOptions = 'test_options';



    public function __construct()
    {
        parent::__construct();
    }

    public function getTaskById($task_id)
    {
        return $this->selectOne($this->tableName, ['task_id' => $task_id]);
    }

    public function getAllSubtasks($taskId, $flagToGetAnswers = false, $pupilId = null)
    {

        $subtasks = $this->select('subtask', ['taskId' => $taskId]);

        $this->execute();
        $subtasks = $this->resultset('array');

        $num = count($subtasks);

        for ($i = 0; $i < $num; $i++) {
            if ($subtasks[$i]->subtaskType == 'test-question' || $subtasks[$i]->subtaskType == 'multiplechoice-questions') {

                $subtasks[$i]->choices = $this->getChoices($subtasks[$i]->subtaskId);
            }
            if ($flagToGetAnswers == 1 && isset($pupilId)) {

                
                $subtasks[$i]->answer = $this->getAnswerByPupilIdAndsubtaskId($subtasks[$i]->subtaskId, $pupilId);
            }
        }
        return $subtasks;
    }
    public function getAnswerByPupilIdAndsubtaskId($subtaskId, $pupilId)
    {
        $tableName = "answers_of_the_pupil";

        return $this->selectOne($tableName, ['subtaskId' => $subtaskId, 'pupilId' => $pupilId]);
    }

    public function getChoices($subtaskId)
    {


        return $this->select($this->tableNameOfOptions, ['subtaskId' => $subtaskId]);
    }

    public function getTasksForDisplaying($userType, $userId)
    {
        switch ($userType) {
            case 'pupil':
                return $this->getAllTasksOfThePupil($userId);
            case 'teacher':
                return $this->getAllTheTasksOfTeacher($userId);
            default:
                return null;
        }
    }
    public function getAllTheTasksOfTeacher($teacherId)
    {

        $this->query("SELECT *  from tasks 
         WHERE tasks.userId=:userId");
        $this->bind(':userId', $teacherId);
        return $this->resultSet();
    }
    function getAllTasksOfThePupil($pupilId)
    {
        $this->query("SELECT tasks.* , users.firstName,users.lastName,pupilstasks.completionStatus from tasks 
        INNER JOIN users ON tasks.userId=users.userId 
        INNER JOIN pupilstasks ON tasks.task_id=pupilstasks.taskId WHERE pupilstasks.pupilId=:pupilId");
        $this->bind(':pupilId', $pupilId);
        return $this->resultSet();
    }
    function findSubtask($id)
    {
        $tableName = 'subtask';
        return  $this->selectOne($tableName, ['taskId' => $id]);
    }
    




    function addAnswersToTask($subtasks, $data)
    {
        foreach ($subtasks as $subtask) {
            $typeSubtask = $subtask->subtaskType;
            $typeOfAnswer = 'answer_option';
            $answerKey = "correctAnswer" . $subtask->subtaskId;

            if ($typeSubtask == 'test-question' || $typeSubtask == 'multiplechoice-question') {
                foreach ($subtask->choices as $i => $choice) {

                    if (isset($data[$answerKey])) {
                        $answer = $data[$answerKey];
                    }
                }
            } elseif ($typeSubtask == 'open-ended-question') {
                $typeOfAnswer = 'answer_text';
                $answerKey = "answer_open_ended";
                if (isset($data[$answerKey])) {
                    $answer = $data[$answerKey];
                }
            }
            if (!$this->addAnswerToSubtask($answer, $subtask->subtaskId, $typeOfAnswer, $data['pupilId'], $subtask->taskId)) {
                return false;
            }
        }
    }
    function addAnswerToSubtask($answer, $subtaskId, String $type, String $pupilId, String $taskId)
    {

        $tableName = 'answers_of_the_pupil';
        return $this->insert($tableName, [
            $type => $answer,
            'subtaskId' => $subtaskId, 'pupilId' => $pupilId, 'taskId' => $taskId
        ]);
    }

    function isCompletedTaskByPupil($taskId, $pupilId)
    {
        $tableName = "pupilstasks";
        $taskOfThePupil = $this->selectOne($tableName, ['taskId' => $taskId, 'pupilId' => $pupilId]);
        if (isset($taskOfThePupil->completionStatus) && $taskOfThePupil->completionStatus == 'Completed') {
            return true;
        }

        return false;
    }
}
