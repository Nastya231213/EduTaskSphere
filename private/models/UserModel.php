

<?php
class UserModel
{

    protected $table = 'users';
    protected $model;


    public function __construct()
    {
        $this->model = new Model();
    }


    public function findUserByEmail($email)
    {

        return $this->model->selectOne($this->table, ['email' => $email]);
    }

    public function getAllPupilsByTeacherId($id)
    {

        $this->model->query("SELECT users.* FROM users LEFT JOIN teacher_pupil_relation 
        ON users.userId=teacher_pupil_relation.pupil_id WHERE users.role='pupil' AND teacher_pupil_relation.teacher_id=:id");
        $this->model->bind(':id', $id);
        return $this->model->resultset();
    }


    public function findUserByUrlAdress($userId)
    {
        return $this->model->selectOne($this->table, ['userId' => $userId]);
    }
    public function findPupilsToAddByKeyword($keyWord, $teacherId, $limit = 5, $offset = 1)
    {
        $database = new Database();
        $query = "SELECT * FROM users WHERE (firstName LIKE :find OR lastName LIKE :find OR email LIKE :find) AND role='pupil'
         AND NOT EXISTS (SELECT 1 FROM teacher_pupil_relation WHERE teacher_pupil_relation.pupil_id=users.userId AND teacher_pupil_relation.teacher_id=:teacher_id)";

        $database->query($query);

        $database->bind('find', $keyWord);
        $database->bind('teacher_id', $teacherId);

        $database->execute();
        return $database->resultset();
    }


    public function insertUser($data)
    {
        return $this->model->insert($this->table, $data);
    }

    public function getAllSolutionsToTask($user_id)
    {
        $database = new Database();
        $query = "SELECT users.firstName, users.lastName, tasks.title, answers_of_the_pupil.*
        FROM users
        JOIN answers_of_the_pupil ON users.userId = answers_of_the_pupil.pupilId
        JOIN tasks on answers_of_the_pupil.taskId=tasks.task_id WHERE answers_of_the_pupil.pupilId = :pupil_id GROUP BY answers_of_the_pupil.taskId";
        $database->query($query);
        $database->bind("pupil_id", $user_id);
        $database->execute();
        return $database->resultset();
    }
    public function makeUserid($data)
    {

        $data['userId'] = strtolower($data['firstName'] . '.' . $data['lastName']);
        if ($this->findUserByUrlAdress($data['userId'])) {
            $data['userId'] .= rand(100, 9999);
        }

        return $data;
    }
    public function addTeachersComments($comments, $user_id)
    {
        if (isSignIn()&& getUserType()=='teacher') {
            
            $teacherId=$_SESSION['user']->user_id;
            $databaseName = 'feedback';
            foreach ($comments as $comment) {
                $this->model->insert($databaseName, ['comment' => $comment, 'user_id' => $user_id,'teacher_id'=>$teacherId]);
            }
        }
    }
}
