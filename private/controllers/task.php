

<?php 

class Task extends Controller{

    function index(){


        $this->view("create task");
    }
    
    function add(){
        $errors=array();
        if(count($_POST)>0){
            $validator=new Validation();
            if($validator->validateTask($_POST)){
                $description=$_POST['description'];
                $deadline=$_POST['deadline'];
                $subjectOfTheTask=$_POST['subject'];
                $type=$_POST['type'];
                $title=$_POST['title'];
                $task_id=randomString();
                $userId=getUserInformation('userId');
                $task=new SimpleTasks();
                $task->addToDatabase($description,$deadline,$subjectOfTheTask,$type,$title,$task_id,$userId);
                $this->redirect('task/addSubtasks/'.$task_id);

            }
            $errors=$validator->getErrors();
           
        }
        $this->view('createTask',['errors'=>$errors]);
    }
    function addSubtasks($id=''){
        $pageTab=isset($_GET['tab'])?$_GET['tab']:'test-question';
        if(!empty($id)){
            $userModel=new UserModel();
            $taskToFind =new SimpleTasks();
            $theCurrentTask= $taskToFind->findTaskInDatabase($id);
            $creatorOfTheTask=$userModel->findUserByUrlAdress($theCurrentTask->userId);
        }

        $this->view('simpleTask',['task'=>$theCurrentTask, 'user'=>$creatorOfTheTask,'pageTab'=>$pageTab]);
    
    }
}