[![Code Climate](https://codeclimate.com/github/JBlond/PHP-XSS-Filter/badges/gpa.svg)](https://codeclimate.com/github/JBlond/PHP-XSS-Filter) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/bf1c2ba8-b292-49de-bebc-93e39344a169/mini.png)](https://insight.sensiolabs.com/projects/bf1c2ba8-b292-49de-bebc-93e39344a169)

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
