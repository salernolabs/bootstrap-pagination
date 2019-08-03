<?php
namespace SalernoLabs\Tests\Pagination\Formatter;

use PHPUnit\Framework\TestCase;
use SalernoLabs\Pagination\Formatter\BootstrapHTML;

/**
 * Class BootstrapHTMLTest
 * @package SalernoLabs\Tests\Pagination\Formatter
 */
class BootstrapHTMLTest extends TestCase
{
    /**
     * Test boostrap generation
     */
    public function testBootstrapGeneration()
    {
        $bootstrapHTML = new BootstrapHTML(3, 10, 150);
        $pagination = $bootstrapHTML
            ->setFirstButton('f')
            ->setItemStride(4)
            ->setLastButton('l')
            ->setNextButton('n')
            ->setPreviousButton('p')
            ->setSpace('_')
            ->generateOutput('/n/#', '#', 'stuff');

        $this->assertStringNotContainsString('>f<', $pagination);
        $this->assertStringContainsString('>l<', $pagination);
        $this->assertStringContainsString('>n<', $pagination);
        $this->assertStringContainsString('>p<', $pagination);
        $this->assertStringContainsString('>_<', $pagination);
    }

    /**
     * Test boostrap generation with a high page count, near the end
     */
    public function testBootstrapGenerationHighPageCount()
    {
        $bootstrapHTML = new BootstrapHTML(99, 10, 1000);
        $pagination = $bootstrapHTML
            ->setFirstButton('f')
            ->setLastButton('l')
            ->setNextButton('n')
            ->setPreviousButton('p')
            ->setSpace('_')
            ->generateOutput('/n/#', '#', 'stuff');
        $this->assertStringContainsString('>f<', $pagination);
        $this->assertStringNotContainsString('>l<', $pagination);
        $this->assertStringContainsString('>n<', $pagination);
    }

    /**
     * Test boostrap generation in the middle of the pagination list
     */
    public function testBootstrapGenerationMidStride()
    {
        $bootstrapHTML = new BootstrapHTML(15, 10, 10000);
        $pagination = $bootstrapHTML
            ->setFirstButton('f')
            ->setLastButton('l')
            ->setNextButton('n')
            ->setPreviousButton('p')
            ->setSpace('_')
            ->generateOutput('/n/#', '#', 'stuff');
        $this->assertStringContainsString('>f<', $pagination);
        $this->assertStringContainsString('>l<', $pagination);
        $this->assertStringContainsString('>n<', $pagination);
        $this->assertStringContainsString('>p<', $pagination);
    }

    /**
     * Test no pages output
     */
    public function testGenerationWhereTotalPagesIsLow()
    {
        $bootstrapHTML = new BootstrapHTML(15, 10, 0);
        $pagination = $bootstrapHTML
            ->setFirstButton('f')
            ->setLastButton('l')
            ->setNextButton('n')
            ->setPreviousButton('p')
            ->setSpace('_')
            ->generateOutput('/n/#', '#', 'stuff');

        $this->assertSame('', $pagination);
    }
}
