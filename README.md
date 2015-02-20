[![Code Climate](https://codeclimate.com/github/JBlond/PHP-XSS-Filter/badges/gpa.svg)](https://codeclimate.com/github/JBlond/PHP-XSS-Filter)

PHP-XSS-Filter
==============

Example 
```PHP
	require './xss_filter.class.php';
	$xss = new xss_filter();
	$string = '<iframe>blah';
	$string = $xss->filter_it($string );
	echo $string;
```
