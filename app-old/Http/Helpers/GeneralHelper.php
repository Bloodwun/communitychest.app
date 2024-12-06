<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

/**
 * Concat two string.
 *
 * @param  string $strA
 * @param  string $strB
 * @param  string $strBetween (optional)
 * @return string
 */
function concatTwoString($strA, $strB, $strBetween = '')
{
    return $strA . $strBetween . $strB;
}
function customIsset($value)
{
    if ($value != null && $value != "" && $value != "NULL" && $value != "null") {
        return true;
    }
    return false;
}

function paginate($items, $perPage = 5, $page = null)
{
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $total = count($items);
    $currentpage = $page;
    $offset = ($currentpage * $perPage) - $perPage ;
    $itemstoshow = array_slice($items , $offset , $perPage);
    return new LengthAwarePaginator($itemstoshow ,$total ,$perPage,   $page,
    [
        'path' => LengthAwarePaginator::resolveCurrentPath(),
    ]);
}
function csvToArray($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;

    $header = [];
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
        {
            if (!$header)
                $header = $row;
            else{
                // Pad the row with empty values if it has fewer columns than the header
                $diff = count($header) - count($row);
                if ($diff > 0) {
                    $row = array_pad($row, count($header), "N/A");
                }
                // Combine the header and row to create the associative array
                $combinedRow = array_combine($header, $row);
                foreach ($combinedRow as $key => &$field) {
                    $combinedRow[$key] = ($key == 'icebreaker') ? json_encode($field) : $field ;
                }
                $data[] = $combinedRow;
            }
        }
        fclose($handle);
    }

    return json_encode($data);
}

function escape_like($string)
{
    $search     = array('%', '_','#','&', "'",'"');
    $replace    = array('\%', '\_', '\#','\&',"\'",'\"');

    return str_replace($search, $replace, $string);
}

