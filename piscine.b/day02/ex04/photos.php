#!/usr/bin/php
<?php 

/*
 * see http://simplehtmldom.sourceforge.net/
 * to get PHP simple HTML DOM Parser
 */

/*
 * error_reporting(E_ALL);
 * ini_set('display_errors', 1);
 */

/*
 * CONST_VERBOSE = 1, to display more messages
 * alternative would have been to use the global keyword or GLOBALS['] ==> but not recommended
 */
define('CONST_VERBOSE', 0);
function msg($str) {
	if (CONST_VERBOSE) {
		echo $str;
	}
}

function validate_url($url) {
	$path = parse_url($url, PHP_URL_PATH);
	$encoded_path = array_map('urlencode', explode('/', $path));
	$url = str_replace($path, implode('/', $encoded_path), $url);
	return filter_var($url, FILTER_VALIDATE_URL) ? true : false;
}

function create_dir($url) {
	// get hostname to create the directory
	$url = parse_url($url);  
	$url = $url['host'];
	if (file_exists($url) && is_dir($url)) {
		return ($url);
	}
	if (!mkdir($url)) {
		msg("failed to create directory \"$url\".\n");
	} else {
		msg("created \"$url\" directory\n");
	}
	return ($url);
}

function tbd($url) {
	// some src like <#=image#> doesnt work !!! 
	// https://www.amazon.fr/<#=image #>
	if(!validate_url($url)) {
		msg("TBD: warning: will not try to get this one as the url is invalid: \"$url\"\n");
		return(false);
	} else {
		return(true);
	}
}

function save_image($url, $dir) {
	$filename = $dir . "/" . preg_replace('/[^a-z0-9-.]/i', '-', basename($url));

	// TBD
	if(!tbd($url)) {
		return (1);
	}

	msg("attempting to save \"$filename\" to $dir/.\n");
	if (file_exists("$filename")) {
		msg("warning: file already exists and will be ovewritten.\n");
	}
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$fh = fopen($filename, 'wb');
	curl_setopt($ch, CURLOPT_FILE, $fh);

	$results = curl_exec($ch);
	if ($results === false) {
		msg("error: failed to save file \"$filename\".\n");
		echo "cURL Error: " . curl_error($ch) . "\n";
		//exit(1);
	}
	curl_close($ch);
	fclose($fh);
}

function get_html_page($url) {
	msg("attempting to get url \"$url\".\n");
	// 1. Initialize 
	$ch = curl_init();

	// 2. Set options
	// URL to send the request to
	curl_setopt($ch, CURLOPT_URL, $url);

	// Return instead of outputting directly
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	// Whether to include the request header in the output. Set to false here
	curl_setopt($ch, CURLOPT_HEADER, 0);

	// to be able to use https
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	//?? see www.amazon.fr
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

	// 3. Execute the request and fetch the response. Check for errors
	$results = curl_exec($ch);
	if ($results === false) {
		msg("failed to get url \"$url\".\n");
		echo "cRUL Error: " . curl_error($ch);
		$results = "";
		//exit(1);
	}
	// 4. close and free up the curl handle
	curl_close($ch);

	return ($results);
}

function rel2abs($rel, $base) {
	// https://stackoverflow.com/questions/1243418/php-how-to-resolve-a-relative-url/1243431#1243431
	// very tiny modification
	$rel_old = $rel;

	/* return if already absolute URL */
	if (parse_url($rel, PHP_URL_SCHEME) != '' || substr($rel, 0, 2) == '//') return $rel;

	/* queries and anchors */
	if ($rel[0]=='#' || $rel[0]=='?') return $base.$rel;

	/* parse base URL and convert to local variables:
	*  $scheme, $host, $path */
	$scheme = parse_url($base, PHP_URL_SCHEME);
	$host = parse_url($base, PHP_URL_HOST);
	$path = parse_url($base, PHP_URL_PATH);

	/* remove non-directory element from path */
	$path = preg_replace('#/[^/]*$#', '', $path);

	/* destroy path if relative url points to root */
	if ($rel[0] == '/') $path = '';

	/* dirty absolute URL */
	$abs = "$host$path/$rel";

	/* replace '//' or '/./' or '/foo/../' with '/' */
	$re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
	for($n = 1; $n > 0; $abs = preg_replace($re, '/', $abs, -1, $n)) {}

	$abs  = $scheme . '://' . $abs;
	msg("rel2abs(): relative \"$rel_old\" converted to absolute \"$abs\".\n"); 
	/* absolute URL is ready! */
	return ($abs);
}

function get_images_paths($html_page, $url) {
	msg("getting images path:\n");
	// /images/home_big.jpg
	$my_a = '<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1';
	$my_reg_exp = $my_a;
	preg_match_all("#$my_reg_exp#im", $html_page, $matches);
	$images = array_values(array_unique($matches[2]));

	for ($i = 0; $i < count($images); $i++) {
		$image = $images[$i];
		$image = rel2abs($image, $url);
		$images[$i] = $image;
	}

	msg("\n\n\n");
	return($images);
}

if($argc < 2) {
	msg("url argument is missing.\n");
    exit(1);
}

$url = $argv[1];
msg("======== url arg ==============\n");
msg("$url\n");
msg("================================\n");

if(!validate_url($url)) {
	msg("warning: seems that the argument is not a valid url.\n");
	// we don't exist : we are going to try anyway!! and see what the curl call will return !!
} else {
	msg("seems that the argument is valid url.\n");
}

// create the directort
$dir = create_dir($url);
msg("======== dir ==================\n");
msg("$dir\n");
msg("use ls -p to show the trailing / or alias ls='ls -p'\n");
msg("===============================\n");

// get the url page
$html_page = get_html_page($url);
if(empty($html_page)) {
	exit(1);
}

// extract the images paths
$images = get_images_paths($html_page, $url);

for ($i = 0; $i < count($images); $i++) {
	msg($images[$i] . "\n");
	save_image($images[$i], $dir);
}

?>
