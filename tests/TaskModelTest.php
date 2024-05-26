<?php

use PHPUnit\Framework\TestCase;

class TaskModelTest extends TestCase
{
    private $taskModel;
    private $mockDb;

    protected function setUp(): void
    {
        $this->mockDb = $this->getMockBuilder(Model::class)
                             ->disableOriginalConstructor()
                             ->getMock();

        $this->taskModel = $this->getMockBuilder(TaskModel::class)
                                ->setMethodsExcept(['__construct'])
                                ->setConstructorArgs([$this->mockDb])
                                ->getMock();
    }

    public function testGetTaskById()
    {
        $taskId = 'task123';
        $expectedTask = (object) ['task_id' => $taskId, 'name' => 'Sample Task'];

        $this->mockDb->expects($this->once())
                     ->method('selectOne')
                     ->with('tasks', ['task_id' => $taskId])
                     ->willReturn($expectedTask);

        $task = $this->taskModel->getTaskById($taskId);
        $this->assertEquals($expectedTask, $task);
    }

    public function testGetAllSubtasks()
    {
        $taskId = 'task123';
        $subtasks = [
            (object) ['subtaskId' => 'subtask1', 'subtaskType' => 'test-question'],
            (object) ['subtaskId' => 'subtask2', 'subtaskType' => 'open-ended-question']
        ];

        $choices = [
            (object) ['subtaskId' => 'subtask1', 'optionText' => 'Choice 1'],
            (object) ['subtaskId' => 'subtask1', 'optionText' => 'Choice 2']
        ];

        $this->mockDb->expects($this->once())
                     ->method('select')
                     ->with('subtask', ['taskId' => $taskId])
                     ->willReturn($subtasks);

        $this->mockDb->expects($this->exactly(1))
                     ->method('select')
                     ->with('test_options', ['subtaskId' => 'subtask1'])
                     ->willReturn($choices);

        $subtasks = $this->taskModel->getAllSubtasks($taskId);
        $this->assertCount(2, $subtasks);
        $this->assertObjectHasAttribute('choices', $subtasks[0]);
        $this->assertEquals($choices, $subtasks[0]->choices);
    }

    public function testGetAnswerByPupilIdAndsubtaskId()
    {
        $subtaskId = 'subtask123';
        $pupilId = 'pupil456';
        $expectedAnswer = (object) ['subtaskId' => $subtaskId, 'pupilId' => $pupilId, 'answer' => 'Sample Answer'];

        $this->mockDb->expects($this->once())
                     ->method('selectOne')
                     ->with('answers_of_the_pupil', ['subtaskId' => $subtaskId, 'pupilId' => $pupilId])
                     ->willReturn($expectedAnswer);

        $answer = $this->taskModel->getAnswerByPupilIdAndsubtaskId($subtaskId, $pupilId);
        $this->assertEquals($expectedAnswer, $answer);
    }

    public function testGetTasksForDisplayingForPupil()
    {
        $userId = 'pupil123';
        $userType = 'pupil';
        $tasks = [
            (object) ['task_id' => 'task1', 'name' => 'Task 1'],
            (object) ['task_id' => 'task2', 'name' => 'Task 2']
        ];

        $this->mockDb->expects($this->once())
                     ->method('query')
                     ->with("SELECT tasks.* , users.firstName,users.lastName,pupilstasks.completionStatus from tasks 
                            INNER JOIN users ON tasks.userId=users.userId 
                            INNER JOIN pupilstasks ON tasks.task_id=pupilstasks.taskId WHERE pupilstasks.pupilId=:pupilId")
                     ->willReturnSelf();

        $this->mockDb->expects($this->once())
                     ->method('bind')
                     ->with(':pupilId', $userId);

        $this->mockDb->expects($this->once())
                     ->method('resultSet')
                     ->willReturn($tasks);

        $result = $this->taskModel->getTasksForDisplaying($userType, $userId);
        $this->assertEquals($tasks, $result);
    }

    public function testIsCompletedTaskByPupil()
    {
        $taskId = 'task123';
        $pupilId = 'pupil456';
        $completedTask = (object) ['completionStatus' => 'Completed'];

        $this->mockDb->expects($this->once())
                     ->method('selectOne')
                     ->with('pupilstasks', ['taskId' => $taskId, 'pupilId' => $pupilId])
                     ->willReturn($completedTask);

        $result = $this->taskModel->isCompletedTaskByPupil($taskId, $pupilId);
        $this->assertTrue($result);
    }

    public function testIsNotCompletedTaskByPupil()
    {
        $taskId = 'task123';
        $pupilId = 'pupil456';
        $incompleteTask = (object) ['completionStatus' => 'Incomplete'];

        $this->mockDb->expects($this->once())
                     ->method('selectOne')
                     ->with('pupilstasks', ['taskId' => $taskId, 'pupilId' => $pupilId])
                     ->willReturn($incompleteTask);

        $result = $this->taskModel->isCompletedTaskByPupil($taskId, $pupilId);
        $this->assertFalse($result);
    }
}
