[![Code Climate](https://codeclimate.com/github/JBlond/PHP-XSS-Filter/badges/gpa.svg)](https://codeclimate.com/github/JBlond/PHP-XSS-Filter) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/bf1c2ba8-b292-49de-bebc-93e39344a169/mini.png)](https://insight.sensiolabs.com/projects/bf1c2ba8-b292-49de-bebc-93e39344a169) [![Codacy Badge](https://api.codacy.com/project/badge/grade/a345b27631f240779f8b016abec85460)](https://www.codacy.com/app/leet31337/PHP-XSS-Filter)
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bhttps%3A%2F%2Fgithub.com%2FJBlond%2FPHP-XSS-Filter.svg?type=shield)](https://app.fossa.io/projects/git%2Bhttps%3A%2F%2Fgithub.com%2FJBlond%2FPHP-XSS-Filter?ref=badge_shield)

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


## License
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bhttps%3A%2F%2Fgithub.com%2FJBlond%2FPHP-XSS-Filter.svg?type=large)](https://app.fossa.io/projects/git%2Bhttps%3A%2F%2Fgithub.com%2FJBlond%2FPHP-XSS-Filter?ref=badge_large)