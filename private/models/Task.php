

<?php


//Composite
abstract class Task
{
    private $description;
    private $deadline;
    private $creationDate;
    private $type;
    private $subject;
    protected $model;

    public function __construct($description, $deadline, $creationDate, $subject, $type)
    {
        $this->model = new Model();
        $this->description = $description;
        $this->deadline = $deadline;
        $this->creationDate = $creationDate;
        $this->subject = $subject;
        $this->type = $type;

    }

    abstract public function addToDatabase();
    abstract public function findTaskInDatabase();
}

