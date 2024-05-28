<?php
/**
 * @file Pagination.php
 * @brief Файл містить визначення класу Pagination.
*/
/**
 * @class Pagination
 * Singleton Pagination class for generating pagination links.
 */
class Pagination
{
    /**
     * @var Pagination|null Instance of Pagination.
     */
    private static $instance;

    /**
     * @var int Current start page number.
     */
    public $start = 1;

    /**
     * @var int Current end page number.
     */
    public $end = 1;

    /**
     * @var int Current page number.
     */
    public $pageNum = 1;

    /**
     * @var int Offset from which data should be fetched.
     */
    public $fromWhich = 0;

    /**
     * @var array Links for pagination.
     */
    public $links = array();

    /**
     * Retrieves the instance of Pagination class.
     * @param int $extraPages Additional pages to show in pagination.
     * @param int $limit Number of items per page.
     * @return Pagination The Pagination instance.
     */
    public static function getInstance($extraPages = 1, $limit = 8)
    {
        if (self::$instance === null) {
            self::$instance = new self($extraPages, $limit);
        }

        return self::$instance;
    }

    /**
     * Pagination constructor.
     * @param int $extraPages Additional pages to show in pagination.
     * @param int $lim Number of items per page.
     */
    public function __construct($extraPages = 1, $lim = 8)
    {
        $pageNumber = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $pageNumber = $pageNumber < 1 ? 1 : $pageNumber;
        $this->fromWhich = ($pageNumber - 1) * $lim;
        $this->pageNum = $pageNumber;
        $this->end =  $pageNumber + $extraPages;
        $this->start = $pageNumber - $extraPages;
        if ($this->start < 1) {
            $this->start = 1;
        }
        $currentLink = ROOT . "/" . str_replace(["url=", "index.php&"], "", $_SERVER['QUERY_STRING']);
        $currentLink = !strstr($currentLink, "page=") ? $currentLink . "&page=1" : $currentLink;
        $nextLink = preg_replace('/page=[0-9]+/', "page=" . ($pageNumber + 1 + $extraPages), $currentLink);
        $firstLink = preg_replace('/page=[0-9]+/', "page=1", $currentLink);
        $this->links['first'] = $firstLink;

        $this->links['current'] = $currentLink;
        $this->links['next'] = $nextLink;
    }

    /**
     * Displays the pagination links.
     */
    public function display()
    {
?>
        <br class="clearfix">
        <div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link" href="<?= $this->links['first']; ?>">First</a></li>
                    <?php for ($i = $this->start; $i <= $this->end; $i++) : ?>
                        <li class="page-item <?= ($i === $this->pageNum) ? 'active' : ''; ?>"><a class="page-link" href="<?= preg_replace('/page=[0-9]+/', "page=" . $i, $this->links['current']); ?>"><?= $i ?></a></li>
                    <?php endfor ?>
                    <li class="page-item"><a class="page-link" href="<?= $this->links['next'] ?>">Next</a></li>
                </ul>
            </nav>
        </div>
        <br>
<?php
    }
}
?>

