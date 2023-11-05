<?php

require_once 'vendor/autoload.php';

use Codecrafted\UrlExtractor\URL;
use Codecrafted\IronElephant\File;

// step one (1) => :
$links = new URL();

// your wallpaper download from this site thus don't change this parameter
$webAddress = 'https://www.bwallpaperhd.com/sitemap.html';

$filename = 'wallpaperPagesList.txt';   // you can change file name
$f = new File($filename);

/**
 * extract page link from site map
 */
$links->extractURL($webAddress)
    ->fileOnly(['html'])
    // ->limit()                        // set limiy of links
    ->showAsHTML();                     // show links in browser
$f->write($links->showURL());           // save links in file