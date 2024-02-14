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
        $tableName = 'tasks';
        return $this->selectOne($tableName, ['task_id' => $task_id]);
    }

    public function getAllSubtasks($taskId)
    {
        $subtasks = $this->select('subtask', ['taskId' => $taskId]);
        $num = count($subtasks);
        for ($i = 0; $i < $num; $i++) {
            if ($subtasks[$i]->subtaskType == 'test-question' || $subtasks[$i]->subtaskType == 'multiplechoice-questions') {
                $subtasks[$i]->choices = $this->getChoices($subtasks[$i]->subtaskId);
            }
        }

        return $subtasks;
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
}
