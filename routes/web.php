<?php

use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;

Route::get('/', function () {
    return view('welcome');
});

function is_valid_domain($url)
{
    $validation = FALSE;
    /*Parse URL*/
    $urlparts = parse_url(filter_var($url, FILTER_SANITIZE_URL));
    /*Check host exist else path assign to host*/
    if (!isset($urlparts['host'])) {
        $urlparts['host'] = $urlparts['path'];
    }

    if ($urlparts['host'] != '') {
        /*Add scheme if not found*/
        if (!isset($urlparts['scheme'])) {
            $urlparts['scheme'] = 'http';
        }
        /*Validation*/
        if (checkdnsrr($urlparts['host'], 'A') && in_array($urlparts['scheme'], array('http', 'https')) && ip2long($urlparts['host']) === FALSE) {
            $urlparts['host'] = preg_replace('/^www\./', '', $urlparts['host']);
            $url = $urlparts['scheme'] . '://' . $urlparts['host'] . "/";

            if (filter_var($url, FILTER_VALIDATE_URL) !== false && @get_headers($url)) {
                $validation = TRUE;
            }
        }
    }

    if (!$validation) {
        echo "Its Invalid Domain Name.";
    } else {
        echo " $url is a Valid Domain Name.";
    }
}

function parseUrlParts()
{
    $url = 'https://freeforts.blogspot.com/2017/01/download-youtube-clone';
    // var_dump(parse_url($url));
    // $url = 'http://username:password@hostname:9090/path?arg=value#anchor';
    var_dump(parse_url($url));
    var_dump(parse_url($url, PHP_URL_SCHEME));
    var_dump(parse_url($url, PHP_URL_USER));
    var_dump(parse_url($url, PHP_URL_PASS));
    var_dump(parse_url($url, PHP_URL_HOST));
    var_dump(parse_url($url, PHP_URL_PORT));
    var_dump(parse_url($url, PHP_URL_PATH));
    var_dump(parse_url($url, PHP_URL_QUERY));
    var_dump(parse_url($url, PHP_URL_FRAGMENT));
}

function checkExistUrl()
{
    $url = "http://www.google.com";
    $headers = @get_headers($url);
    if ($headers && strpos($headers[0], '200')) {
        $status = "URL Exist";
    } else {
        $status = "URL Doesn't Exist";
    }
    echo $status;
}

function isSiteAvailible($url)
{
    // Check, if a valid url is provided
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }
    // Initialize cURL
    $curlInit = curl_init($url);

    // Set options
    curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curlInit, CURLOPT_HEADER, true);
    curl_setopt($curlInit, CURLOPT_NOBODY, true);
    curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

    // Get response
    $response = curl_exec($curlInit);

    // Close a cURL session
    curl_close($curlInit);

    return $response ? "true" : "false";
}

function snap($url)
{
    //Link to download file...
    //Code to get the file...
    $data = file_get_contents($url);
    //save as?
    $filename = "test.html";
    // //save the file...
    $fh = fopen($filename, "w");
    fwrite($fh, $data);
    fclose($fh);
    //display link to the file you just saved...
    // echo "<a href='" . $filename . "'>Click Here</a> to download the file...";
}
// snap('https://fonts.bunny.net/');
// https:://www.goovvgle.com/
// If I use :: In the Link It returns NOHING at all 
// $x = isSiteAvailible('https://www.goovvgle.com/');
// @checkExistUrl();
// is_valid_domain('//www:80');
// parseUrlParts();
// $url  = request()->input('search');

Route::get('/search', function () {
    
    return view('search');
})->name('search');
