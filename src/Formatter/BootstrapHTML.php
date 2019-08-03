<?php
namespace SalernoLabs\Pagination\Formatter;

/**
 * This formatted pagination class can return Bootstrap HTML
 * @package SalernoLabs\Pagination\Formatter
 */
class BootstrapHTML extends Base
{
    /**
     * @inheritDoc
     */
    public function generateOutput(
        string $paginationUrl,
        string $pageNumberConstant = '#',
        string $additionalUrlData = ''
    ) {
        $data = $this->getPaginationData();

        if ($data->getTotalPages() <= 1) {
            return '';
        }

        $output = '<ul class="pagination justify-content-center">';

        $cFirst = ($data->getPageNumber() - $this->formatItemStride);
        $cLast = ($data->getPageNumber() + ($this->formatItemStride - 1));

        if ($cFirst > 1) {
            $output .= sprintf(
                '<li class="page-item"><a class="page-link" href="%s">%s</a></li>%s',
                str_replace($pageNumberConstant, '1', $paginationUrl) . $additionalUrlData,
                $this->formatFieldFirst,
                $this->formatFieldSpace
            );
        } else {
            $cFirst = 1;
        }

        if ($data->getPageNumber() !== 1) {
            $output .= sprintf(
                '<li class="page-item"><a class="page-link" href="%s">%s</a></li>%s',
                str_replace($pageNumberConstant, ($data->getPageNumber() - 1), $paginationUrl) . $additionalUrlData,
                $this->formatFieldPrevious,
                $this->formatFieldSpace
            );
        }


        if ($cLast > $data->getTotalPages()) {
            $cLast = $data->getTotalPages();
        }

        for ($i = $cFirst; $i <= $cLast; ++$i) {
            if ($i === $data->getPageNumber()) {
                $output .= sprintf(
                    '<li class="page-item active"><a class="page-link" href="javascript:;">%d</a></li>%s',
                    $i,
                    $this->formatFieldSpace
                );
            } else {
                $output .= sprintf(
                    '<li class="page-item"><a class="page-link" href="%s">%d</a></li>%s',
                    str_replace($pageNumberConstant, $i, $paginationUrl) . $additionalUrlData,
                    $i,
                    $this->formatFieldSpace
                );
            }
        }

        if ($data->getPageNumber() !== $data->getTotalPages()) {
            $output .= sprintf(
                '<li class="page-item"><a class="page-link" href="%s">%s</a></li>%s',
                str_replace($pageNumberConstant, ($data->getPageNumber() + 1), $paginationUrl) . $additionalUrlData,
                $this->formatFieldNext,
                $this->formatFieldSpace
            );
        }

        if ($cLast < $data->getTotalPages()) {
            $output .= sprintf(
                '<li class="page-item"><a class="page-link" href="%s">%s</a></li>',
                str_replace($pageNumberConstant, $data->getTotalPages(), $paginationUrl) . $additionalUrlData,
                $this->formatFieldLast
            );
        }

        $output .= "</ul>\n";

        return $output;
    }
}
