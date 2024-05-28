<?php

/**
 * @file MultipleChoiceStrategy.php
 * @brief Файл містить визначення класу MultipleChoiceStrategy.
 */
/**
 * @class MultipleChoiceStrategy
 * @brief Клас для реалізації стратегії обробки підзавдань типу "множинний вибір".
 *
 */
class MultipleChoiceStrategy implements SubTaskStrategy
{
    /**
     * @var Model $model Об'єкт моделі для роботи з базою даних.
     */
    private $model;

    /**
     * @var string $subtaskType Тип підзавдання, встановлений як 'multiplechoice-question'.
     */
    private $subtaskType = 'multiplechoice-question';

    public function evaluateAnswer($userAnswer, $correctAnswer)
    {
    }
    /**
     * @brief Додає питання типу "множинний вибір" до бази даних.
     *
     * @param MultipleChoiceTask $multiplechoiceQuestion Питання типу "множинний вибір", яке потрібно додати до бази даних.
     * @throws InvalidArgumentException Якщо переданий об'єкт не є екземпляром MultipleChoiceTask.
     */
    public function addToDatabase($multiplechoiceQuestion)
    {
        if ($multiplechoiceQuestion instanceof MultipleChoiceTask) {
            $this->model = new Model();
            $data['question'] = $multiplechoiceQuestion->getQuestion();
            $data['taskId'] = $multiplechoiceQuestion->getTaskId();
            $data['subtaskId'] = randomString();
            $data['subtaskType'] = $this->subtaskType;

            $table = "subtask";
            $this->model->insert($table, $data);
            $choices = $multiplechoiceQuestion->getChoices();
            $correctAnswers = $multiplechoiceQuestion->getCorrectAnswers();
            $dataOption['subtaskId'] = $data['subtaskId'];
            $table = 'test_options';
            foreach ($choices as $choice) {

                $dataOption['optionText'] = $choice;
                if (in_array($choice, $correctAnswers)) {
                    $dataOption['isCorrect'] = 1;
                } else {
                    $dataOption['isCorrect'] = 0;
                }
                $this->model->insert($table, $dataOption);
            }
        }
    }
}
