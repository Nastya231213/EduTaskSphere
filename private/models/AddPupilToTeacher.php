

<?php


class AddPupilToTeacher implements Command
{
    private $model;
    private $data;
    private $tableName = "teacher_pupil_relation";

    public function __construct($data)
    {
        $this->model = new Model();
        $this->data = $data;
    }
    public function execute()
    {
        $this->model->insert($this->tableName, $this->data);
    }
}
