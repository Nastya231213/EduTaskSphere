<?php
/**
 * @class TaskModel
 * @brief Клас для роботи з завданнями
 */
class TaskModel extends Model
{
    /**
     * @var string $tableName Ім'я таблиці завдань.
     */
    private $tableName = 'tasks';

    /**
     * @var string $tableNameOfOptions Ім'я таблиці опцій тестових завдань.
     */
    private $tableNameOfOptions = 'test_options';

    /**
     * @brief Конструктор класу.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @brief Отримати завдання за його ідентифікатором.
     * @param string $task_id Ідентифікатор завдання.
     * @return mixed Завдання з бази даних.
     */
    public function getTaskById($task_id)
    {
        return $this->selectOne($this->tableName, ['task_id' => $task_id]);
    }

    /**
     * @brief Отримати всі підзавдання для певного завдання.
     * @param string $taskId Ідентифікатор завдання.
     * @param bool $flagToGetAnswers Чи отримувати відповіді (за замовчуванням false).
     * @param string|null $pupilId Ідентифікатор учня (за замовчуванням null).
     * @return array Масив підзавдань.
     */
    public function getAllSubtasks($taskId, $flagToGetAnswers = false, $pupilId = null)
    {
        $subtasks = $this->select('subtask', ['taskId' => $taskId]);
        $this->execute();
        $subtasks = $this->resultset('array');
        $num = count($subtasks);

        for ($i = 0; $i < $num; $i++) {
            if ($subtasks[$i]->subtaskType == 'test-question' || $subtasks[$i]->subtaskType == 'multiplechoice-questions') {
                $subtasks[$i]->choices = $this->getChoices($subtasks[$i]->subtaskId);
            }
            if ($flagToGetAnswers == 1 && isset($pupilId)) {
                $subtasks[$i]->answer = $this->getAnswerByPupilIdAndsubtaskId($subtasks[$i]->subtaskId, $pupilId);
            }
        }
        return $subtasks;
    }

    /**
     * @brief Отримати відповідь учня за ідентифікатором підзавдання та учня.
     * @param string $subtaskId Ідентифікатор підзавдання.
     * @param string $pupilId Ідентифікатор учня.
     * @return mixed Відповідь учня.
     */
    public function getAnswerByPupilIdAndsubtaskId($subtaskId, $pupilId)
    {
        $tableName = "answers_of_the_pupil";
        return $this->selectOne($tableName, ['subtaskId' => $subtaskId, 'pupilId' => $pupilId]);
    }

    /**
     * @brief Отримати опції для підзавдання.
     * @param string $subtaskId Ідентифікатор підзавдання.
     * @return mixed Опції підзавдання.
     */
    public function getChoices($subtaskId)
    {
        return $this->select($this->tableNameOfOptions, ['subtaskId' => $subtaskId]);
    }

    /**
     * @brief Отримати завдання для відображення в залежності від типу користувача.
     * @param string $userType Тип користувача.
     * @param string $userId Ідентифікатор користувача.
     * @return mixed Завдання для відображення.
     */
    public function getTasksForDisplaying($userType, $userId)
    {
        switch ($userType) {
            case 'pupil':
                return $this->getAllTasksOfThePupil($userId);
            case 'teacher':
                return $this->getAllTheTasksOfTeacher($userId);
            default:
                return null;
        }
    }

    /**
     * @brief Отримати всі завдання для певного вчителя.
     * @param string $teacherId Ідентифікатор вчителя.
     * @return mixed Завдання вчителя.
     */
    public function getAllTheTasksOfTeacher($teacherId)
    {
        $this->query("SELECT * FROM tasks WHERE tasks.userId=:userId");
        $this->bind(':userId', $teacherId);
        return $this->resultSet();
    }

    /**
     * @brief Отримати всі завдання для певного учня.
     * @param string $pupilId Ідентифікатор учня.
     * @return mixed Завдання учня.
     */
    function getAllTasksOfThePupil($pupilId)
    {
        $this->query("SELECT tasks.*, users.firstName, users.lastName, pupilstasks.completionStatus 
                      FROM tasks 
                      INNER JOIN users ON tasks.userId=users.userId 
                      INNER JOIN pupilstasks ON tasks.task_id=pupilstasks.taskId 
                      WHERE pupilstasks.pupilId=:pupilId");
        $this->bind(':pupilId', $pupilId);
        return $this->resultSet();
    }

    /**
     * @brief Знайти підзавдання за ідентифікатором завдання.
     * @param string $id Ідентифікатор завдання.
     * @return mixed Підзавдання.
     */
    function findSubtask($id)
    {
        $tableName = 'subtask';
        return $this->selectOne($tableName, ['taskId' => $id]);
    }

    /**
     * @brief Додати відповіді на підзавдання.
     * @param array $subtasks Масив підзавдань.
     * @param array $data Дані з відповідями.
     * @return bool Статус виконання.
     */
    function addAnswersToTask($subtasks, $data)
    {
        foreach ($subtasks as $subtask) {
            $typeSubtask = $subtask->subtaskType;
            $typeOfAnswer = 'answer_option';
            $answerKey = "correctAnswer" . $subtask->subtaskId;

            if ($typeSubtask == 'test-question' || $typeSubtask == 'multiplechoice-question') {
                foreach ($subtask->choices as $i => $choice) {
                    if (isset($data[$answerKey])) {
                        $answer = $data[$answerKey];
                    }
                }
            } elseif ($typeSubtask == 'open-ended-question') {
                $typeOfAnswer = 'answer_text';
                $answerKey = "answer_open_ended";
                if (isset($data[$answerKey])) {
                    $answer = $data[$answerKey];
                }
            }
            if (!$this->addAnswerToSubtask($answer, $subtask->subtaskId, $typeOfAnswer, $data['pupilId'], $subtask->taskId)) {
                return false;
            }
        }
    }

    /**
     * @brief Додати відповідь на підзавдання.
     * @param mixed $answer Відповідь.
     * @param string $subtaskId Ідентифікатор підзавдання.
     * @param string $type Тип відповіді.
     * @param string $pupilId Ідентифікатор учня.
     * @param string $taskId Ідентифікатор завдання.
     * @return bool Статус виконання.
     */
    function addAnswerToSubtask($answer, $subtaskId, String $type, String $pupilId, String $taskId)
    {
        $tableName = 'answers_of_the_pupil';
        return $this->insert($tableName, [
            $type => $answer,
            'subtaskId' => $subtaskId, 
            'pupilId' => $pupilId, 
            'taskId' => $taskId
        ]);
    }

    /**
     * @brief Перевірити, чи завершено завдання учнем.
     * @param string $taskId Ідентифікатор завдання.
     * @param string $pupilId Ідентифікатор учня.
     * @return bool Статус завершення завдання.
     */
    function isCompletedTaskByPupil($taskId, $pupilId)
    {
        $tableName = "pupilstasks";
        $taskOfThePupil = $this->selectOne($tableName, ['taskId' => $taskId, 'pupilId' => $pupilId]);
        if (isset($taskOfThePupil->completionStatus) && $taskOfThePupil->completionStatus == 'Completed') {
            return true;
        }

        return false;
    }
}
