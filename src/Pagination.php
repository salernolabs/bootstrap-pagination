<?php

namespace SalernoLabs\Pagination;

/**
 * Class Pagination
 * @package SalernoLabs\Pagination
 */
class Pagination
{
    /** @var int  */
    private const DEFAULT_PAGENUMBER = 1;
    /** @var int  */
    private const DEFAULT_ITEMS_PER_PAGE = 10;
    /** @var int  */
    private const DEFAULT_TOTAL_ITEMS = 0;

    /**
     * Page number
     * @var integer
     */
    private $pageNumber;

    /**
     * Number of items per page
     * @var integer
     */
    private $numberOfItemsPerPage;

    /**
     * Total items
     * @var integer
     */
    private $totalItems;

    /**
     * Pagination constructor.
     * @param int $pageNumber The current page number
     * @param int $numberOfItemsPerPage The number of items per page
     * @param int $totalItems The total items
     */
    public function __construct(
        int $pageNumber = self::DEFAULT_PAGENUMBER,
        int $numberOfItemsPerPage = self::DEFAULT_ITEMS_PER_PAGE,
        int $totalItems = self::DEFAULT_TOTAL_ITEMS
    ) {
        $this->setPageNumber($pageNumber);
        $this->setNumberOfItemsPerPage($numberOfItemsPerPage);
        $this->setTotalItems($totalItems);
    }

    /**
     * Set page number
     * @param int $pageNumber The page number to set
     * @return $this
     * @throws \OutOfBoundsException If the page number is less than 1
     */
    public function setPageNumber(int $pageNumber): self
    {
        if ($pageNumber < 0) {
            throw new \OutOfBoundsException('Page number is out of bounds, <= 0');
        }

        $this->pageNumber = $pageNumber;

        return $this;
    }

    /**
     * Set number of items per page
     * @param int $numberOfItemsPerPage The number of items per page
     * @return $this
     */
    public function setNumberOfItemsPerPage(int $numberOfItemsPerPage): self
    {
        $this->numberOfItemsPerPage = $numberOfItemsPerPage;

        return $this;
    }

    /**
     * Set total items
     * @param int $totalItems The number of total items
     * @return $this
     */
    public function setTotalItems(int $totalItems): self
    {
        $this->totalItems = $totalItems;

        return $this;
    }

    /**
     * Get the pagination data
     * @return array
     */
    public function getPaginationData(): array
    {
        $totalPages = intval(ceil($this->totalItems / $this->numberOfItemsPerPage));
        return [
            'pageNumber' => $this->pageNumber > $totalPages ? $totalPages : $this->pageNumber,
            'totalItems' => $this->totalItems,
            'itemsPerPage' => $this->numberOfItemsPerPage,
            'offset' => (($this->pageNumber - 1) * $this->numberOfItemsPerPage),
            'totalPages' => $totalPages,
        ];
    }
}