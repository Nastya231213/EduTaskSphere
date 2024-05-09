<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include('C:/xampp/htdocs/EduTaskSphere/private/models/Interpreter.php');
  include('C:/xampp/htdocs/EduTaskSphere/private/models/DeadlineFilter.php');
  include('C:/xampp/htdocs/EduTaskSphere/private/models/SubjectFilter.php');
  include('C:/xampp/htdocs/EduTaskSphere/private/models/SearchKeyFilter.php');


  $searchKey = $_POST['search'];
  $subject = $_POST['subject'];
  $deadline = $_POST['deadline'];

  $filteredTasks = filterTasks(json_decode($_POST['tasks']), $subject, $deadline, $searchKey);
  $role = $_POST['role'];
  responseForFiltering($role,$filteredTasks);
  
}
function esc($var)
{
  return htmlspecialchars($var);
}


function getMessage($data)
{
  if (isset($_SESSION['messageSuccess'])) {
    $data['messageSuccess'] = $_SESSION['messageSuccess'];
    unset($_SESSION['messageSuccess']);
  } else if (isset($_SESSION['messageError'])) {
    $data['messageError'] = $_SESSION['messageError'];
    unset($_SESSION['messageError']);
  }
  return $data;
}
function getVar($key, $default = "")
{

  if (isset($_POST[$key])) {
    return $_POST[$key];
  }
  return $default;
}
function getUserInformation($key, $default = "")
{

  if (isset($_SESSION['user']->$key)) {
    return $_SESSION['user']->$key;
  }
  return $default;
}
function getRole()
{
  $role = null;
  if (isset($_SESSION['user'])) {
    $role = $_SESSION['user']->role;
  }
  return $role;
}
function viewsPathInc($view)
{
  if (file_exists("../private/views/" . $view . ".inc.php")) {
    return "../private/views/" . $view . ".inc.php";
  } else {
    return "../private/views/404.inc.php";
  }
}
function isSignIn()
{
  if (isset($_SESSION['user'])) {
    return true;
  }
  return false;
}
function getUserType()
{
  if (isset($_SESSION['user'])) {
    return $_SESSION['user']->role;
  }
  return null;
}

function randomString($length = 30)
{
  $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'z', 'x', 'c', 'v', 'b', 'n', 'm', 'A', 'B', 'C', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'Z', 'X', 'C', 'V', 'B', 'N', 'M');
  $text = "";
  for ($x = 0; $x < $length; $x++) {
    $random = rand(0, 61);
    $text .= $array[$random];
  }
  return $text;
}

function getTaskById($task_id)
{
  $model = new Model();
  $tableName = 'tasks';
  return $model->selectOne($tableName, ['task_id' => $task_id]);
}


function getImage($gender)
{
  $image_path = ASSETS . '/images/man.jpg';

  if ($gender == 'female') {
    $image_path = ASSETS . '/images/female.jpg';
  }
  return $image_path;
}


function getPupilsThatNotHaveTask($taskId, $teacherId, $key = '', $offset = 0, $limit = 5)
{

  $database = new Database();
  $adition = '';
  if (!empty($key)) {
    $adition = "AND (firstName like :find || lastName like :find || email like :find )";
  }
  $query = "SELECT * from  users WHERE NOT EXISTS 
  (SELECT 1 FROM pupilstasks WHERE  pupilstasks.pupilId=users.userId 
  AND pupilstasks.taskId=:taskId)  AND 
  EXISTS(SELECT 1 FROM teacher_pupil_relation WHERE teacher_pupil_relation.pupil_id=users.userId AND teacher_id=:teacher_id)
  " . $adition . " LIMIT $limit OFFSET $offset";
  $database->query($query);
  $database->bind('taskId', $taskId);
  $database->bind('teacher_id', $teacherId);

  if (!empty($key)) {
    $database->bind('find', $key);
  }
  $database->execute();
  return $database->resultset();
}
function filterTasks($tasks, $subject, $deadline, $searchKey)
{

  $filteredTasks = $tasks;

  if ($deadline !== null && $deadline !== '') {
    $deadlineFilter = new DeadlineFilter($deadline);
    try {
      $filteredTasks = $deadlineFilter->interpret($filteredTasks);
    } catch (InvalidArgumentException $e) {
      echo $e->getMessage();
      return $tasks;
    }
  }
  if ($subject !== null && $subject !== '') {

    $subjectFilter = new SubjectFilter($subject);
    try {
      $filteredTasks = $subjectFilter->interpret($filteredTasks);
    } catch (InvalidArgumentException $e) {
      echo $e->getMessage();
      return $tasks;
    }
  }

  if ($searchKey !== null && $searchKey !== '') {

    $searchKeyFilter = new SearchKeyFilter($searchKey);
    try {
      $filteredTasks = $searchKeyFilter->interpret($filteredTasks);
    } catch (InvalidArgumentException $e) {
      echo $e->getMessage();
      return $tasks;
    }
  }
  return $filteredTasks;
}

function responseForFiltering($role,$filteredTasks){
  $htmlOutput = '';

  $htmlOutput .= '<tr>';
  $htmlOutput .= '<th>Details</th>';
  $htmlOutput .= '<th>Task</th>';
  $htmlOutput .= '<th>Description</th>';
  $htmlOutput .= '<th>Deadline</th>';
  if ($role == 'pupil') {
    $htmlOutput .= '<th>Teacher</th>';
    $htmlOutput .= '<th>Status</th>';
  }
  $htmlOutput .= '<th>Actions</th>';
  if ($role == 'teacher') {
    $htmlOutput .= '<th><a href="' . ROOT . '/task/add"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add New</button></a></th>';
  }
  $htmlOutput .= '</tr>';
  if (!empty($filteredTasks)) {


    foreach ($filteredTasks as $task) {
      $htmlOutput .= '<tr>';
      $htmlOutput .= '<td><a class="btn btn-info" href="' . ROOT . '/task/subtasks/' . $task->task_id . '"><i class="fa fa-chevron-right"></i></a></td>';
      $htmlOutput .= '<td>' . $task->title . '</td>';
      $htmlOutput .= '<td>' . $task->description . '</td>';
      $htmlOutput .= '<td>' . $task->deadline . '</td>';
      if ($role == 'pupil') {
        $htmlOutput .= '<td>' . $task->firstName . ' ' . $task->lastName . '</td>';
        $htmlOutput .= '<td>' . $task->completionStatus . '</td>';
      }
      $htmlOutput .= '<td>';
      if ($role == 'teacher') {
        $htmlOutput .= '<a href="' . ROOT . '/task/edit/' . $task->task_id . '"><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></a>';
        $htmlOutput .= '<a href="' . ROOT . '/task/sendToPupils/' . $task->task_id . '"><button class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Add user</button></a>';
        $htmlOutput .= '<a href="' . ROOT . '/task/users/' . $task->task_id . '"><button class="btn btn-sm btn-info"><i class="fas fa-users"></i> View users</button></a>';
      } else  if ($task->completionStatus == 'Not Started') {
        $htmlOutput .= '<a href="' . ROOT . '/task/accept/' . $task->task_id . '"><button class="btn btn-sm btn-success"><i class="fa fa-check"></i> Accept</button></a>';
        $htmlOutput .= '<a href="' . ROOT . '/task/reject/' . $task->task_id . '/' . $task->userId . '"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Reject</button></a>';
      } else {
        $htmlOutput .= '<p class="text-success">The task is accepted.</p>';
        $htmlOutput .= '<a href="' . ROOT . '/task/perfom/' . $task->task_id . '"><button class="btn btn-sm btn-info"> Perform the task</button></a>';
      }
      $htmlOutput .= '</td>';
      $htmlOutput .= '</tr>';
    }
  } else {
    $htmlOutput .= '<tr><td colspan="6">No tasks were found at this time</td></tr>';
  }
  echo $htmlOutput;
}