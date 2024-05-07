
<?php
class ConcreteSubTaskFactory implements SubTaskFactory {
    public function createTestTask($question, $correctAnswer,$choices,$taskId): TestSubtask {
        return new TestSubtask($question, $correctAnswer,$choices,$taskId);
    }

    public function createOpenEndedTask($question, $correctAnswer,$taskId): SubTask {
        return new OpenEndedTask($question, $correctAnswer,$taskId);
    }

    public function createMultipleChoiceTask($question, $choices, $correctAnswers,$taskId): SubTask {
        return new MultipleChoiceTask($question, $choices, $correctAnswers,$taskId);
    }
}