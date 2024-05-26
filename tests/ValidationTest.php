<?php

use PHPUnit\Framework\TestCase;

include('../private/core/autoload.php');

class ValidationTest extends TestCase
{
    private $validation;
    private $userModelMock;

    protected function setUp(): void
    {
        $this->userModelMock = $this->createMock(UserModel::class);
        $this->validation = $this->getMockBuilder(Validation::class)
                                 ->setMethodsExcept(['validateUser', 'validateTask', 'getErrors'])
                                 ->getMock();
    }

    public function testValidateUserValidData()
    {
        $data = [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'password' => 'password123',
            'confirmPassword' => 'password123',
            'email' => 'john.doe@example.com',
            'gender' => 'male',
            'role' => 'teacher'
        ];

        $this->userModelMock->expects($this->once())
                            ->method('findUserByEmail')
                            ->with($data['email'])
                            ->willReturn(false);

        $result = $this->validation->validateUser($data);
        $this->assertTrue($result);
        $this->assertEmpty($this->validation->getErrors());
    }

    public function testValidateUserInvalidData()
    {
        $data = [
            'firstName' => 'John123',
            'lastName' => '',
            'password' => 'password123',
            'confirmPassword' => 'password321',
            'email' => 'john.doeexample.com',
            'gender' => 'unknown',
            'role' => 'admin'
        ];

        $this->userModelMock->expects($this->once())
                            ->method('findUserByEmail')
                            ->with($data['email'])
                            ->willReturn(true);

        $result = $this->validation->validateUser($data);
        $this->assertFalse($result);
        $errors = $this->validation->getErrors();

        $this->assertEquals("Letters can be in the first name", $errors['first_name']);
        $this->assertEquals("Letters can be in the last name", $errors['last_name']);
        $this->assertEquals("The passwords aren't equal", $errors['password']);
        $this->assertEquals("That email is already in", $errors['email']);
        $this->assertEquals("Email isn't appropriate", $errors['email']);
        $this->assertEquals("Gender isn't appropriate", $errors['gender']);
        $this->assertEquals("Role isn't appropriate", $errors['role']);
    }

    public function testValidateTaskValidData()
    {
        $data = [
            'title' => 'Math Homework',
            'description' => 'Solve the equations.',
            'deadline' => date('Y-m-d', strtotime('+1 day')),
            'type' => 'homework',
            'subject' => 'Math'
        ];

        $result = $this->validation->validateTask($data);
        $this->assertTrue($result);
        $this->assertEmpty($this->validation->getErrors());
    }

    public function testValidateTaskInvalidData()
    {
        $data = [
            'title' => 'Math123 Homework',
            'description' => '<script>alert("hack")</script>',
            'deadline' => date('Y-m-d', strtotime('-1 day')),
            'type' => 'assignment',
            'subject' => 'History'
        ];

        $result = $this->validation->validateTask($data);
        $this->assertFalse($result);
        $errors = $this->validation->getErrors();

        $this->assertEquals("Only letters can be in the title", $errors['title']);
        $this->assertEquals("Description can't be empty and contain special html chars", $errors['description']);
        $this->assertEquals("Choose the correct deadline", $errors['deadline']);
        $this->assertEquals("Type isn't appropriate", $errors['type']);
        $this->assertEquals("Subject isn't appropriate", $errors['subject']);
    }
}
