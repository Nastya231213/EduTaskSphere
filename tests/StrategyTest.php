<?php


use PHPUnit\Framework\TestCase;
include('../private/core/autoload.php');

class StrategyTest extends TestCase {
    public function testMultipleChoiceStrategyAddToDatabase() {
        $modelMock = $this->createMock(Model::class);
        $multipleChoiceTask = new MultipleChoiceTask(
            'What is the capital of France?',
            ['Paris', 'Berlin', 'Madrid', 'Rome'],
            ['Paris'],
            'task123'
        );

        $modelMock->expects($this->exactly(2))
                  ->method('insert')
                  ->withConsecutive(
                      ['subtask', $this->callback(function($data) {
                          return $data['question'] === 'What is the capital of France?' && 
                                 $data['taskId'] === 'task123' &&
                                 $data['subtaskType'] === 'multiplechoice-question';
                      })],
                      ['test_options', $this->callback(function($dataOption) {
                          return isset($dataOption['optionText']) && 
                                 isset($dataOption['isCorrect']);
                      })]
                  )
                  ->willReturn(true);

        $strategy = new MultipleChoiceStrategy();
        $strategy->addToDatabase($multipleChoiceTask);
    }

    public function testOpenEndedStrategyAddToDatabase() {
        $modelMock = $this->createMock(Model::class);
        $openEndedTask = new OpenEndedTask(
            'Explain the theory of relativity.',
            'Relativity is a theory...',
            'task123'
        );

        $modelMock->expects($this->once())
                  ->method('insert')
                  ->with('subtask', $this->callback(function($data) {
                      return $data['question'] === 'Explain the theory of relativity.' && 
                             $data['correctAnswer'] === 'Relativity is a theory...' &&
                             $data['taskId'] === 'task123' &&
                             $data['subtaskType'] === 'open-ended-question';
                  }))
                  ->willReturn(true);

        $strategy = new OpenEndedStrategy();
        $strategy->addToDatabase($openEndedTask);
    }

    public function testTestStrategyAddToDatabase() {
        $modelMock = $this->createMock(Model::class);
        $testSubtask = new TestSubtask(
            'What is 2 + 2?',
            1,
            ['4', '3', '2', '1'],
            'task123'
        );

        $modelMock->expects($this->exactly(2))
                  ->method('insert')
                  ->withConsecutive(
                      ['subtask', $this->callback(function($data) {
                          return $data['question'] === 'What is 2 + 2?' && 
                                 $data['taskId'] === 'task123' &&
                                 $data['subtaskType'] === 'test-question';
                      })],
                      ['test_options', $this->callback(function($dataOption) {
                          return isset($dataOption['optionText']) && 
                                 isset($dataOption['isCorrect']);
                      })]
                  )
                  ->willReturn(true);

        $strategy = new TestStrategy();
        $strategy->addToDatabase($testSubtask);
    }
}
