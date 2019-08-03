<?php

namespace SalernoLabs\Tests\Pagination;

use PHPUnit\Framework\TestCase;
use SalernoLabs\Pagination\PageData;

/**
 * Class PageDataTest
 * @package SalernoLabs\Tests\Pagination
 */
class PageDataTest extends TestCase
{
    /**
     * Test PageData response object
     */
    public function testPageData()
    {
        $pageData = new PageData(1, 5, 10);
        $this->assertSame(2, $pageData->getTotalPages());
        $this->assertSame(1, $pageData->getPageNumber());
        $this->assertSame(5, $pageData->getItemsPerPage());
        $this->assertSame(10, $pageData->getTotalItems());
        $this->assertSame(0, $pageData->getOffset());
    }

    /**
     * Test clamping of page number to total pages
     */
    public function testPageNumberTooHigh()
    {
        $pageData = new PageData(15, 5, 10);
        $this->assertSame(2, $pageData->getPageNumber());
    }
}
