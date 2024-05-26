<?php
use PHPUnit\Framework\TestCase;
include('../private/core/autoload.php');

class FilterTest extends TestCase {
    public function testDeadlineFilter() {
        $tasks = [
            new Task('2024-05-25', 'Math'),
            new Task('2024-05-26', 'Science'),
            new Task('2024-05-27', 'English')
        ];

        $deadlineFilter = new DeadlineFilter('2024-05-26');

        $filteredTasks = $deadlineFilter->interpret($tasks);

        $this->assertCount(2, $filteredTasks);
        $this->assertEquals('2024-05-25', $filteredTasks[0]->deadline);
        $this->assertEquals('2024-05-26', $filteredTasks[1]->deadline);
    }

    public function testDeadlineFilterWithInvalidTasks() {
        $this->expectException(InvalidArgumentException::class);
        $deadlineFilter = new DeadlineFilter('2024-05-26');
        $deadlineFilter->interpret('not an array');
    }

    public function testSubjectFilter() {
        $tasks = [
            new Task('2024-05-25', 'Math'),
            new Task('2024-05-26', 'Science'),
            new Task('2024-05-27', 'Math')
        ];

        $subjectFilter = new SubjectFilter('Math');

        $filteredTasks = $subjectFilter->interpret($tasks);

        $this->assertCount(2, $filteredTasks);
        $this->assertEquals('Math', $filteredTasks[0]->subject);
        $this->assertEquals('Math', $filteredTasks[1]->subject);
    }

    public function testSubjectFilterWithInvalidTasks() {
        $this->expectException(InvalidArgumentException::class);
        $subjectFilter = new SubjectFilter('Math');
        $subjectFilter->interpret('not an array');
    }
}