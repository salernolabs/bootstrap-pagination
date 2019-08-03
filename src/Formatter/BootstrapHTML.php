<?php

namespace SalernoLabs\Pagination\Formatter;

/**
 * Class BootstrapHTML
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
        $pageNumber = $data['pageNumber'];
        $totalPages = $data['totalPages'];

        if ($totalPages <= 1) {
            return '';
        }

        $output = '<ul class="pagination justify-content-center">';

        $cFirst = ($pageNumber - $this->formatItemStride);
        $cLast = ($pageNumber + ($this->formatItemStride - 1));

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

        if ($pageNumber !== 1) {
            $output .= sprintf(
                '<li class="page-item"><a class="page-link" href="%s">%s</a></li>%s',
                str_replace($pageNumberConstant, ($pageNumber - 1), $paginationUrl) . $additionalUrlData,
                $this->formatFieldPrevious,
                $this->formatFieldSpace
            );
        }


        if ($cLast > $totalPages) {
            $cLast = $totalPages;
        }

        for ($i = $cFirst; $i <= $cLast; ++$i) {
            if ($i === $pageNumber) {
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

        if ($pageNumber !== $totalPages) {
            $output .= sprintf(
                '<li class="page-item"><a class="page-link" href="%s">%s</a></li>%s',
                str_replace($pageNumberConstant, ($pageNumber + 1), $paginationUrl) . $additionalUrlData,
                $this->formatFieldNext,
                $this->formatFieldSpace
            );
        }

        if ($cLast < $totalPages) {
            $output .= sprintf(
                '<li class="page-item"><a class="page-link" href="%s">%s</a></li>',
                str_replace($pageNumberConstant, $totalPages, $paginationUrl) . $additionalUrlData,
                $this->formatFieldLast
            );
        }

        $output .= "</ul>\n";

        return $output;
    }
}
