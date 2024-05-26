<?php
use PHPUnit\Framework\TestCase;
include('../private/core/autoload.php');

class ModelTest extends TestCase
{
    private $model;

    protected function setUp(): void
    {
        $this->model = $this->getMockBuilder(Model::class)
                            ->disableOriginalConstructor()
                            ->setMethods(['query', 'bind', 'resultset', 'single', 'execute'])
                            ->getMock();

    }

    public function testSelectWithoutWhere()
    {
        $table = 'users';
        $sql = "SELECT * FROM $table";

        $this->model->expects($this->once())
                    ->method('query')
                    ->with($sql);

        $this->model->expects($this->once())
                    ->method('resultset')
                    ->willReturn(['result1', 'result2']);

        $result = $this->model->select($table);
        $this->assertEquals(['result1', 'result2'], $result);
    }

    public function testSelectWithWhere()
    {
        $table = 'users';
        $where = ['id' => 1];
        $sql = "SELECT * FROM $table WHERE id = :id";

        $this->model->expects($this->once())
                    ->method('query')
                    ->with($sql);

        $this->model->expects($this->once())
                    ->method('bind')
                    ->with(':id', 1);

        $this->model->expects($this->once())
                    ->method('resultset')
                    ->willReturn(['result1']);

        $result = $this->model->select($table, $where);
        $this->assertEquals(['result1'], $result);
    }

    public function testSelectOneWithoutWhere()
    {
        $table = 'users';
        $sql = "SELECT * FROM $table";

        $this->model->expects($this->once())
                    ->method('query')
                    ->with($sql);

        $this->model->expects($this->once())
                    ->method('single')
                    ->willReturn('result1');

        $result = $this->model->selectOne($table);
        $this->assertEquals('result1', $result);
    }

    public function testInsert()
    {
        $table = 'users';
        $data = ['name' => 'John', 'email' => 'john@example.com'];
        $keys = implode(',', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($keys) VALUES($values)";

        $this->model->expects($this->once())
                    ->method('query')
                    ->with($sql);

        $this->model->expects($this->exactly(2))
                    ->method('bind')
                    ->withConsecutive(
                        [':name', 'John'],
                        [':email', 'john@example.com']
                    );

        $this->model->expects($this->once())
                    ->method('execute')
                    ->willReturn(true);

        $result = $this->model->insert($table, $data);
        $this->assertTrue($result);
    }

    public function testDelete()
    {
        $table = 'users';
        $where = ['id' => 1];
        $sql = "DELETE FROM $table WHERE id = :id";

        $this->model->expects($this->once())
                    ->method('query')
                    ->with($sql);

        $this->model->expects($this->once())
                    ->method('bind')
                    ->with(':id', 1);

        $this->model->expects($this->once())
                    ->method('execute')
                    ->willReturn(true);

        $result = $this->model->delete($table, $where);
        $this->assertTrue($result);
    }

    public function testUpdate()
    {
        $table = 'users';
        $data = ['name' => 'John'];
        $where = ['id' => 1];
        $sql = "UPDATE $table SET name = :name WHERE id = :id";

        $this->model->expects($this->once())
                    ->method('query')
                    ->with($sql);

        $this->model->expects($this->exactly(2))
                    ->method('bind')
                    ->withConsecutive(
                        [':name', 'John'],
                        [':id', 1]
                    );

        $this->model->expects($this->once())
                    ->method('execute')
                    ->willReturn(true);

        $result = $this->model->update($table, $data, $where);
        $this->assertTrue($result);
    }
}