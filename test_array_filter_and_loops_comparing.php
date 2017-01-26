<?php
/*
execute this from console by typing: php test_array_filter_and_loops_comparing.php
*/

ini_set('memory_limit', '500M');
$data = range(0, 1000000);

// array_filter loop average 0.74 seconds
$start = microtime(true);
$data = array_filter($data, function ($item) {
    return $item%2;
});
$end = microtime(true);
 
echo "\narray_filter loop: ";
echo $end - $start;
echo "\tsec.";
echo "\t";
echo echo_memory_usage();
 
// Foreach loop average 0.37 seconds
$start = microtime(true);
$newData = array();
foreach ($data as $item) {
    if (!empty($item) && $item % 2) {
        $newData[] = $item;
    }
}
$end = microtime(true);
 
echo "\nForeach loop:      ";
echo $end - $start;
echo "\tsec.";
echo "\t";
echo echo_memory_usage();

// For loop average 0.61 seconds
$start = microtime(true);
$newData = array();
$numItems = count($data);
for($i=0;$i<=$numItems;$i++) {
    if (!empty($data[$i]) && $data[$i] % 2) {
        $newData[] = $data[$i];
    }
}
$end = microtime(true);

echo "\nFoor loop:         ";
echo $end - $start;
echo "\tsec.";
echo "\t";
echo echo_memory_usage();

// While loop average 0.58 seconds
$start = microtime(true);
$newData = array();
$numItems = count($data);
$i = 0;
while ($i <= $numItems) {
    if (!empty($data[$i]) && $data[$i]%2) {
        $newData[] = $data[$i];
    }
    $i++;
}
$end = microtime(true);
 
echo "\nWhile loop:        ";
echo $end - $start;
echo "\tsec.";
echo "\t";
echo echo_memory_usage();

// Last new line:
echo "\n\n";

/**
 * Print memory usage.
 */
function echo_memory_usage() { 
    $mem_usage = memory_get_usage(true); 
    
    if ($mem_usage < 1024) 
        echo $mem_usage." bytes"; 
    elseif ($mem_usage < 1048576) 
        echo round($mem_usage/1024,2)." kilobytes"; 
    else 
        echo round($mem_usage/1048576,2)." megabytes"; 
} 


