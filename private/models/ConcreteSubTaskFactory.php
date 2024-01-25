
<?php
class ConcreteSubTaskFactory implements SubTaskFactory {
    public function createTestTask($question, $correctAnswer,$choices): SubTask {
        return new TestTask($question, $correctAnswer,$choices);
    }

    public function createOpenEndedTask($question, $correctAnswer): SubTask {
        return new OpenEndedTask($question, $correctAnswer);
    }

    public function createMultipleChoiceTask($question, $choices, $correctAnswers): SubTask {
        return new MultipleChoiceTask($question, $choices, $correctAnswers);
    }
}