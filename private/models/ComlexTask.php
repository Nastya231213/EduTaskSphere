
<?php
class ComplexTask extends Tasks
{
    private $subTasks = [];
    private $taskId;
    public function __construct($id) {
        $this->taskId=$id;

    }
    public function addSubtask(SubTask $subtask)
    {
        
    }
    public function removeSubtask(SubTask $subtask)
    {
    }

}
