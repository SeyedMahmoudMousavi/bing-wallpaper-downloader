<?php

require_once 'vendor/autoload.php';

use Codecrafted\BingWallpaperDownloader\Creator;
use Codecrafted\IronElephant\File;

// step tow (2) => :

$bing = new Creator();
$f = new File();
/**
 * create links if each url
 *
 * options : 
 */

// name of wallpaper page list file
$pageListFileName = 'wallpaperPagesList.txt';

$year = null;       // get all years
// $year = '2023';  // get only year =>> 2023

$month = null;      // get all months
// $month = '12';   // only get month =>> 12

$bing->createLinkImage(trim((string)$f->read($pageListFileName), "\n"), $year, $month);

// you can change file name
$downloadListFileName = 'wallpaperDownloadsList.txt';

// save wallpapers list in file
$bing
    ->showDownloadList()
    ->saveDownloadList($downloadListFileName);
