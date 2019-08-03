<?php

namespace SalernoLabs\Pagination\Formatter;

use SalernoLabs\Pagination\Pagination;

/**
 * Abstract base formatter class
 * @package SalernoLabs\Pagination\Formatter
 */
abstract class Base extends Pagination
{
    /** @var string  */
    protected $formatFieldNext = '&rsaquo;';
    /** @var string  */
    protected $formatFieldPrevious = '&lsaquo;';
    /** @var string  */
    protected $formatFieldFirst = '&laquo;';
    /** @var string  */
    protected $formatFieldLast = '&raquo;';
    /** @var string  */
    protected $formatFieldSpace = '&nbsp;';
    /** @var int  */
    protected $formatItemStride = 5;

    /**
     * Generate the output
     * eg. ->generateOutput('/news/#', '#', '?stuff=neato');
     * @param string $paginationUrl The pagination URL to use
     * @param string $pageNumberConstant The constant to replace in the URL for the page number
     * @param string $additionalUrlData Any additional url decorator to add
     * @return string
     */
    abstract public function generateOutput(
        string $paginationUrl,
        string $pageNumberConstant = '#',
        string $additionalUrlData = ''
    );

    /**
     * @param string $nextButton The text to use for the next button
     * @return $this
     */
    public function setNextButton(string $nextButton)
    {
        $this->formatFieldNext = $nextButton;
        return $this;
    }

    /**
     * @param string $previousButton
     * @return $this
     */
    public function setPreviousButton(string $previousButton)
    {
        $this->formatFieldPrevious = $previousButton;
        return $this;
    }

    /**
     * @param string $firstButton
     * @return $this
     */
    public function setFirstButton(string $firstButton)
    {
        $this->formatFieldFirst = $firstButton;
        return $this;
    }

    /**
     * @param string $lastButton
     * @return $this
     */
    public function setLastButton(string $lastButton)
    {
        $this->formatFieldLast = $lastButton;
        return $this;
    }

    /**
     * @param string $space
     * @return $this
     */
    public function setSpace(string $space)
    {
        $this->formatFieldSpace = $space;
        return $this;
    }

    /**
     * @param int $stride
     * @return $this
     */
    public function setItemStride(int $stride)
    {
        $this->formatItemStride = $stride;
        return $this;
    }
}
