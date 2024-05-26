<?php

use PHPUnit\Framework\TestCase;
include('../private/core/autoload.php');

class CommandTest extends TestCase
{
    private $model;

    protected function setUp(): void
    {
        $this->model = $this->createMock(Model::class);
    }

    public function testAddPupilToTeacher()
    {
        $data = ['teacher_id' => 1, 'pupil_id' => 2];
        $this->model->expects($this->once())
                    ->method('insert')
                    ->with('teacher_pupil_relation', $data);

        $command = new AddPupilToTeacher($data);
        $commandReflection = new ReflectionClass($command);
        $modelProperty = $commandReflection->getProperty('model');
        $modelProperty->setAccessible(true);
        $modelProperty->setValue($command, $this->model);
        $command->execute();
    }

    public function testDeletePupilFromTeacher()
    {
        $conditions = ['teacher_id' => 1, 'pupil_id' => 2];
        $this->model->expects($this->once())
                    ->method('delete')
                    ->with('teacher_pupil_relation', $conditions);

        $command = new DeletePupilFromTeacher($conditions);
        $commandReflection = new ReflectionClass($command);
        $modelProperty = $commandReflection->getProperty('model');
        $modelProperty->setAccessible(true);
        $modelProperty->setValue($command, $this->model);
        $command->execute();
    }

    public function testDeleteTaskFromPupil()
    {
        $taskId = 1;
        $pupilId = 2;
        $conditions = ['taskId' => $taskId, 'pupilId' => $pupilId];
        $this->model->expects($this->once())
                    ->method('delete')
                    ->with('pupilstasks', $conditions);

        $command = new DeleteTaskFromPupil($taskId, $pupilId);
        $commandReflection = new ReflectionClass($command);
        $modelProperty = $commandReflection->getProperty('model');
        $modelProperty->setAccessible(true);
        $modelProperty->setValue($command, $this->model);
        $command->execute();
    }

    public function testSendTaskToPupil()
    {
        $taskData = ['task_id' => 1, 'pupil_id' => 2, 'task_description' => 'Homework'];
        $this->model->expects($this->once())
                    ->method('insert')
                    ->with('pupilstasks', $taskData);

        $command = new SendTaskToPupil($taskData);
        $commandReflection = new ReflectionClass($command);
        $modelProperty = $commandReflection->getProperty('model');
        $modelProperty->setAccessible(true);
        $modelProperty->setValue($command, $this->model);
        $command->execute();
    }

    public function testCommandInvoker()
    {
        $command = $this->createMock(Command::class);
        $command->expects($this->once())
                ->method('execute');

        $invoker = new CommandInvoker();
        $invoker->setCommand($command);
        $invoker->executeCommand();
    }
}
