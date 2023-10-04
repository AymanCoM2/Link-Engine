<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

function resolveShortUrl($shortUrl)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $shortUrl);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $headers = curl_getinfo($ch);
    // Extract the resolved URL from the response headers
    $longUrl = null;
    if (isset($headers['redirect_url'])) {
        $longUrl = $headers['redirect_url'];
    }
    curl_close($ch);
    return $longUrl;
}

Route::get('/search', function () {
    // Example usage
    // $shortUrl = 'https://lnkd.in/dqxtE7Vy';   // ! Not Working
    $shortUrl = 'https://bit.ly/462WZEy'; // * Working 

    $longUrl = resolveShortUrl($shortUrl);

    if ($longUrl) {
        echo 'Expanded URL: ' . $longUrl;
    } else {
        echo 'Unable to expand URL.';
    }
    return view('search');
})->name('search');


// 