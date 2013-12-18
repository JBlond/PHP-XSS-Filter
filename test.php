<pre>
<?php
require './xss_filter.class.php';
$xss = new xss_filter();
$string = '<iframe>blah';
$string = $xss->filter_it($string);
echo $string .'<br>';
$string2 = "http://example.com/lorem/ipsum.php?a=asas'asas&asas=";
$xss->allow_http();
$string2 = $xss->filter_it($string2);
echo $string2 .'<br>';
?>
</pre>