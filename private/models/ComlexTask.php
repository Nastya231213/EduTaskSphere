
<?php
class ComplexTask extends Task
{
    private $subTasks = [];

    public function addSubTask(SubTask $task)
    {
        $this->subTasks[] = $task;
    }

    public function addToDatabase()
    {
    }
    public function findTaskInDatabase()
    {
    }
}
