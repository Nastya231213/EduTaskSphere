
<?php
use PHPUnit\Framework\TestCase;
include('../private/core/autoload.php');
class PaginationTest extends TestCase
{
    private $pagination;

    protected function setUp(): void
    {
        $reflection = new ReflectionClass(Pagination::class);
        $instance = $reflection->getProperty('instance');
        $instance->setAccessible(true);
        $instance->setValue(null, null);

        $_SERVER['QUERY_STRING'] = "url=test&page=1";
        define('ROOT', 'http://example.com');

        $this->pagination = Pagination::getInstance(1, 8);
    }

    public function testSingletonInstance()
    {
        $pagination1 = Pagination::getInstance();
        $pagination2 = Pagination::getInstance();

        $this->assertSame($pagination1, $pagination2, "Both instances should be the same");
    }

    public function testInitialValues()
    {
        $this->assertEquals(1, $this->pagination->start, "Initial start value should be 1");
        $this->assertEquals(2, $this->pagination->end, "Initial end value should be 2");
        $this->assertEquals(1, $this->pagination->pageNum, "Initial pageNum should be 1");
        $this->assertEquals(0, $this->pagination->fromWhich, "Initial fromWhich should be 0");
    }

    public function testPaginationLinks()
    {
        $links = $this->pagination->links;
        $currentLink = 'http://example.com/&page=1';

        $this->assertStringContainsString("page=1", $links['first'], "First link should contain page=1");
        $this->assertStringContainsString("page=1", $links['current'], "Current link should contain page=1");
        $this->assertStringContainsString("page=3", $links['next'], "Next link should contain page=3");

        $this->assertEquals('http://example.com/&page=1', $links['first'], "First link is incorrect");
        $this->assertEquals('http://example.com/&page=1', $links['current'], "Current link is incorrect");
        $this->assertEquals('http://example.com/&page=3', $links['next'], "Next link is incorrect");
    }

    public function testDisplay()
    {
        $this->expectOutputRegex('/<nav aria-label="Page navigation example">/');
        $this->expectOutputRegex('/<li class="page-item"><a class="page-link" href="http:\/\/example.com\/&page=1">First<\/a><\/li>/');
        $this->expectOutputRegex('/<li class="page-item active"><a class="page-link" href="http:\/\/example.com\/&page=1">1<\/a><\/li>/');
        $this->expectOutputRegex('/<li class="page-item"><a class="page-link" href="http:\/\/example.com\/&page=2">2<\/a><\/li>/');
        $this->expectOutputRegex('/<li class="page-item"><a class="page-link" href="http:\/\/example.com\/&page=3">Next<\/a><\/li>/');

        $this->pagination->display();
    }
}
