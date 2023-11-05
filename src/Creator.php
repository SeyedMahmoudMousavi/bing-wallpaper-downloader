<?php

namespace Codecrafted\BingWallpaperDownloader;

use Codecrafted\IronElephant\File;

require_once 'vendor/autoload.php';

/**
 * Download class for geting wallpapers
 */
class Creator
{

    protected $links = null;

    public function createLinkImage(string $pageLinks, $year = null, $month = null)
    {

        $pageLinks = str_replace("\r\n", "\n", $pageLinks);
        $urls = explode("\n", $pageLinks);

        if (is_null($year)) {
            // $year = date("Y");
            $year = [];
            $this_year = (int)date("Y");
            for ($i = 2010; $i <= $this_year; $i++) {
                $year[] = "$i";
            }
        } else {
            if ((int)$year < 100) {
                $year = "20$year";
            }
        }

        if (is_null($month)) {
            $month = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        } else {
            if ((int)$month < 10) {
                $month = "0$month";
            }
        }


        $downloadLinks = [];

        foreach ($urls as $url) {
            $pageContent = file_get_contents($url);

            if (is_array($year)) {
                foreach ($year as $y) {
                    if (is_array($month)) {
                        foreach ($month as $m) {
                            $needle = "<p><a href=\"https://www.bwallpaperhd.com/wp-content/uploads/$y/$m/";
                            $position = strpos($pageContent, $needle);
                            if ($position !== false) {
                                // link found now scape from month loop
                                break;
                            }
                        }
                    } else {
                        $needle = "<p><a href=\"https://www.bwallpaperhd.com/wp-content/uploads/$y/$month/";
                        $position = strpos($pageContent, $needle);
                    }
                    if ($position !== false) {
                        // link found now scape from year loop
                        break;
                    }
                }
            } else {
                if (is_array($month)) {
                    foreach ($month as $m) {
                        $needle = "<p><a href=\"https://www.bwallpaperhd.com/wp-content/uploads/$year/$m/";
                        $position = strpos($pageContent, $needle);
                        if ($position !== false) {
                            // link found now scape from month loop
                            break;
                        }
                    }
                } else {
                    $needle = "<p><a href=\"https://www.bwallpaperhd.com/wp-content/uploads/$year/$month/";
                    $position = strpos($pageContent, $needle);
                }
            }

            if ($position === false) {
                // if not found any link scape from this address
                continue;
            }


            $position2 = strpos($pageContent, '"', ($position + strlen($needle)));

            $file_lentgh = $position2 - ($position + strlen($needle));

            $file_name = substr($pageContent, ($position + strlen($needle)), $file_lentgh);

            $downloadLinks[] = str_replace('<p><a href="', '', $needle) . $file_name;
        }

        $this->links = $downloadLinks;
        return $this;
    }


    /**
     * get download list as a array
     *
     * @return array
     */
    public function getDownloadList(): array
    {
        return $this->links;
    }

    /**
     * show list in browser
     *
     * @return object
     */
    function showDownloadList(): object
    {
        echo "<pre>";
        foreach ($this->links as $link) {
            echo "$link\n";
        }
        echo "</pre>";
        return $this;
    }

    public function saveDownloadList(string $fileName)
    {
        $links = '';
        foreach ($this->links as $link) {
            $links .= "$link\n";
        }

        $links = trim($links, "\n");

        $f = new File($fileName);
        $f->write($links);
        return $this;
    }
}
