PHP-XSS-Filter
==============

Example 

	require './xss_filter.class.php';
	$xss = new xss_filter();
	$string = '&lt;iframe&gt;blah';
	$string = $xss->filter_it($string );
	echo $string;