<?php

namespace SalernoLabs\Tests\Pagination;

use PHPUnit\Framework\TestCase;
use SalernoLabs\Pagination\PageData;
use SalernoLabs\Pagination\Pagination;

/**
 * Class PaginationTest
 * @package SalernoLabs\Tests\Pagination
 */
class PaginationTest extends TestCase
{
    /**
     * Test the creation and adjustment of the pagination class
     */
    public function testPaginationClass()
    {
        $pagination = new Pagination();
        $pagination
            ->setPageNumber(3)
            ->setNumberOfItemsPerPage(10)
            ->setTotalItems(41);

        $this->assertEquals(
            new PageData(3, 10, 41),
            $pagination->getPaginationData()
        );
    }

    /**
     * Test pagination class invalid page number
     */
    public function testPaginationClassInvalidPageNumber()
    {
        $this->expectException(\OutOfBoundsException::class);
        new Pagination(-1);
    }
}
