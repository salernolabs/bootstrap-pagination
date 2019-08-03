<?php
namespace SalernoLabs\Pagination;

/**
 * This class wraps the output pagination data to return back into the calling app
 * @package SalernoLabs\Pagination
 */
class PageData
{
    /**
     * @var int
     */
    private $pageNumber = 0;

    /**
     * @var int
     */
    private $totalItems = 0;

    /**
     * @var int
     */
    private $itemsPerPage = 0;

    /**
     * @var int
     */
    private $offset = 0;

    /**
     * @var int
     */
    private $totalPages = 0;

    /**
     * PageData constructor.
     * @param int $pageNumber The page number
     * @param int $itemsPerPage The items per page
     * @param int $totalItems The total items
     */
    public function __construct(
        int $pageNumber,
        int $itemsPerPage,
        int $totalItems
    ) {
        $this->pageNumber = $pageNumber;
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;

        $this->offset = ($this->pageNumber - 1) * $this->itemsPerPage;
        $this->totalPages = intval(ceil($this->totalItems / $this->itemsPerPage));
    }

    /**
     * Get page number
     * @return int
     */
    public function getPageNumber(): int
    {
        if ($this->pageNumber > $this->totalPages) {
            return $this->totalPages;
        }

        return $this->pageNumber;
    }

    /**
     * Get total items
     * @return int
     */
    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    /**
     * Get items per page
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    /**
     * Get database offset value
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Get total pages
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }
}
