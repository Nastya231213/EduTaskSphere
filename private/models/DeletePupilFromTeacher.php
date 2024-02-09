

<?php


class DeletePupilFromTeacher implements Command
{
    private $model;
    private $conditions;
    private $tableName = "teacher_pupil_relation";

    public function __construct($conditions)
    {
        $this->model = new Model();
        $this->conditions = $conditions;
    }
    public function execute()
    {
        return $this->model->delete($this->tableName, $this->conditions);
    }
}
