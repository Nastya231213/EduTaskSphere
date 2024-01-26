

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
        $message="";
        $pageTab=isset($_GET['tab'])?$_GET['tab']:'test-question';
        if(!empty($id)){
            $userModel=new UserModel();
            $taskToFind =new SimpleTasks();
            $theCurrentTask= $taskToFind->findTaskInDatabase($id);
            
            $creatorOfTheTask=$userModel->findUserByUrlAdress($theCurrentTask->userId);
        }
        if(isset($theCurrentTask->taskId) && $taskToFind->findSubtask($theCurrentTask->taskId)){
            $message='Simple task consists of the one subtask!';
            $this->redirect('messagePage?message='.$message);
        }
        if(count($_POST)>0){
            $subtaskFactory=new ConcreteSubTaskFactory();
            if($pageTab=='test-question'){
                $question=$_POST['questionTest'];
                $choices[]=$_POST['option1'];
                $choices[]=$_POST['option2'];
                $choices[]=$_POST['option3'];
                $choices[]=$_POST['option4'];
                
                $correctAnswer=$_POST['correctAnswer'];
                $testQuestion=$subtaskFactory->createTestTask($question,$correctAnswer,$choices,$id);
                $strategy=$testQuestion->getStrategy();
                $strategy->addToDatabase($testQuestion);
             
                
            }else if($pageTab=='open-ended-question'){
                $question=$_POST['question'];
                $correctAnswer=$_POST['correctAnswer'];
                $openEndedQuestion=$subtaskFactory->createOpenEndedTask($question,$correctAnswer,$id);
                $strategy=$openEndedQuestion->getStrategy();
                $strategy->addToDatabase($openEndedQuestion);
            }else if($pageTab=='multiplechoice-question'){
                $question=$_POST['questionMultichoice'];
                $choices=$_POST['choices'];
                $correctAnswersIndexes=isset($_POST['correctAnswers'])?$_POST['correctAnswers']:[];
                $correctAnswers=array();
                foreach($correctAnswersIndexes as $index){
                    $correctAnswers[]=$choices[$index-1];
                }

                $multiplechoiceQuestion=$subtaskFactory->createMultipleChoiceTask($question,$choices,$correctAnswers,$id);
                $strategy= $multiplechoiceQuestion->getStrategy();
                $strategy->addToDatabase($multiplechoiceQuestion);

            }
            if($theCurrentTask->type=='simple'){
                $message='Simple task consists of the one subtask!';
                $this->redirect('messagePage?message='.$message);
            }else{
                $message="Subtask was successfully added";
            }
        }

        $this->view('simpleTask',['task'=>$theCurrentTask, 'user'=>$creatorOfTheTask,'pageTab'=>$pageTab,'message'=>$message]);
    
    }
}