<?php
header('Content-Type: text/html; charset=utf-8');

require './lib/jblond/xss_filter.class.php';
$xss = new jblond\xss_filter();

// load über nasty test
$test_lines = file('teststrings/blns.txt',FILE_SKIP_EMPTY_LINES);


foreach($test_lines as $test_line){
	echo $xss->filter_it($test_line) . '<br>' ."\n";
}
