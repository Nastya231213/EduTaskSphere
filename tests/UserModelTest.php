<?php 
include('../private/core/autoload.php');

use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase
{
    protected $userModel;
    protected $modelMock;

    protected function setUp(): void
    {
        // Create a mock object for Model
        $this->modelMock = $this->createMock(Model::class);

        // Inject the mock object into UserModel
        $this->userModel = $this->getMockBuilder(UserModel::class)
                                ->setConstructorArgs([])
                                ->setMethods(null)
                                ->getMock();
        
        // Replace the model property with the mock
        $this->userModel->model = $this->modelMock;
    }

    public function testFindUserByEmail()
    {
        $email = 'test@example.com';
        $expectedResult = ['email' => $email, 'name' => 'Test User'];

        // Set up the expectation for the selectOne method
        $this->modelMock->expects($this->once())
                        ->method('selectOne')
                        ->with('users', ['email' => $email])
                        ->willReturn($expectedResult);

        $result = $this->userModel->findUserByEmail($email);
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetAllPupilsByTeacherId()
    {
        $teacherId = 1;
        $expectedResult = [
            ['userId' => 1, 'firstName' => 'John', 'lastName' => 'Doe', 'role' => 'pupil'],
            ['userId' => 2, 'firstName' => 'Jane', 'lastName' => 'Doe', 'role' => 'pupil']
        ];

        // Set up the expectations for the query, bind, and resultset methods
        $this->modelMock->expects($this->once())
                        ->method('query')
                        ->with("SELECT users.* FROM users LEFT JOIN teacher_pupil_relation 
                                ON users.userId=teacher_pupil_relation.pupil_id WHERE users.role='pupil' AND teacher_pupil_relation.teacher_id=:id");

        $this->modelMock->expects($this->once())
                        ->method('bind')
                        ->with(':id', $teacherId);

        $this->modelMock->expects($this->once())
                        ->method('resultset')
                        ->willReturn($expectedResult);

        $result = $this->userModel->getAllPupilsByTeacherId($teacherId);
        $this->assertEquals($expectedResult, $result);
    }

    public function testFindUserByUrlAdress()
    {
        $userId = 'john.doe';
        $expectedResult = ['userId' => $userId, 'name' => 'John Doe'];

        // Set up the expectation for the selectOne method
        $this->modelMock->expects($this->once())
                        ->method('selectOne')
                        ->with('users', ['userId' => $userId])
                        ->willReturn($expectedResult);

        $result = $this->userModel->findUserByUrlAdress($userId);
        $this->assertEquals($expectedResult, $result);
    }

    public function testInsertUser()
    {
        $data = ['email' => 'test@example.com', 'name' => 'Test User'];
        $expectedResult = true;

        // Set up the expectation for the insert method
        $this->modelMock->expects($this->once())
                        ->method('insert')
                        ->with('users', $data)
                        ->willReturn($expectedResult);

        $result = $this->userModel->insertUser($data);
        $this->assertTrue($result);
    }

    public function testMakeUserid()
    {
        $data = ['firstName' => 'John', 'lastName' => 'Doe'];
        $expectedResult = ['firstName' => 'John', 'lastName' => 'Doe', 'userId' => 'john.doe'];

        // Set up the expectation for the findUserByUrlAdress method
        $this->modelMock->expects($this->once())
                        ->method('selectOne')
                        ->with('users', ['userId' => 'john.doe'])
                        ->willReturn(null); // No user found

        $result = $this->userModel->makeUserid($data);
        $this->assertEquals($expectedResult, $result);
    }

    public function testAddTeachersComments()
    {
        // Assuming isSignIn and getUserType are global functions that need to be mocked
        $comments = ['Good job!', 'Needs improvement.'];
        $user_id = 1;
        $teacher_id = 2;

        // Mock global functions
        $this->modelMock->expects($this->any())
                        ->method('insert')
                        ->with('feedback', $this->anything())
                        ->willReturn(true);

        $this->userModel->addTeachersComments($comments, $user_id);
    }

    protected function tearDown(): void
    {
        // Clean up after each test
        unset($this->userModel);
    }
}
