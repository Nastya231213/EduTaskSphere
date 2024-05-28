
<?php
/**
 * @file ReviewState.php
 * @brief Файл містить визначення класу ReviewState.
*/
/**
 * Class ReviewState
 * @brief Represents the state of a task being under review.
 *
 * This class implements the TasksState interface and is responsible for updating the completion status of a task to "Review".
 */
class ReviewState implements TasksState {
    /**
     * @var string $state The state of the task being "Review".
     */
    private $state = "Review";

    /**
     * @var string $tableName The name of the table in the database storing pupil tasks.
     */
    private $tableName = "pupilstasks";

    /**
     * Update the state of the task to "Review" for the given task and pupil.
     *
     * @param int $taskId The ID of the task.
     * @param int $pupilId The ID of the pupil.
     * @return bool True if the update was successful, false otherwise.
     */
    public function updateState($taskId, $pupilId) {
        $model = new Model();
        return $model->update($this->tableName, ['completionStatus' => $this->state], ['taskId' => $taskId, 'pupilId' => $pupilId]);
    }
}
?>