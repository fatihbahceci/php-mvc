<?php
class bslists
{
    public static function pagination(int $total, int $current, string $prefix = "", int $visible = 5)
    {
        if ($total > 0) {
            $start = 1;
            $end = $total;
            if ($visible > 0) {
                $start = max(1, round($current - ($visible / 2)));
                $end = min($total, $start + $visible - 1);
                if (($end - $start + 1) < $visible) {
                    $start = max(1, $end - $visible + 1);

                }
            }

            if ($current <= 0) {
                $current = 1;
            }

            $r =
                '<nav aria-label="...">' .
                '<ul class="pagination">';
            if ($current > 1) {
                $r .=
                    '<li class="page-item">' .
                    '<a class="page-link" href="' . $prefix . ($current - 1) . '" tabindex="-1">&#xab;</a>' .
                    '</li>';
            }
            for ($i = $start; $i < $end + 1; $i++) {
                $r .= '<li class="page-item ' . ($current != $i ? '' : 'active') . '">' .
                    '<a class="page-link" href="' . $prefix . $i . '">' . $i . ' <span class="sr-only">' . ($current != $i ? '' : '(current)') . '</span></a>' .
                    '</li>';
            }

            if ($current < $total) {
                $r .= '<li class="page-item">
                <a class="page-link" href="' . $prefix . ($current + 1) . '">&#xbb;</a>
                </li>';
            }
            $r .=
                '</ul>' .
                '</nav>';

            return $r;
        } else {
            return "";
        }
    }
}

/*
<nav aria-label="...">
<ul class="pagination">
<li class="page-item disabled">
<a class="page-link" href="#" tabindex="-1">Previous</a>
</li>

<li class="page-item"><a class="page-link" href="#">1</a></li>
<li class="page-item active">
<a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
</li>
<li class="page-item"><a class="page-link" href="#">3</a></li>

<li class="page-item">
<a class="page-link" href="#">Next</a>
</li>
</ul>
</nav>
 */
