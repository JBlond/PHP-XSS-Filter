<?php
header('Content-Type: text/html; charset=utf-8');

require './lib/jblond/xss_filter.class.php';
$xss = new jblond\xss_filter();

$string = "teilnehmer_nr=1&singleTarif=1 AND (SELECT * FROM (SELECT(SLEEP(5)))lVqc)&abschlussart=jahresabschluss&reisebeginn=-1&reiseende=-1&beginnJahresVers=1445292000&teilnmAlter=29&weltgeltung=1";

echo $xss->filter_it($string) . '<br><br><br>';

$mysqli = new \mysqli("localhost", "root", "", "mysql");

/* check connection */
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
}
else
{
	echo $mysqli->real_escape_string($string);
}
