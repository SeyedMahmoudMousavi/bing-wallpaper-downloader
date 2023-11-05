# Bing Wallpaper Downloader
download bing wallpaper 1920*1080 easily

## How to use this downloader
1. first setup PHP on your system or use xampp and similar
2. **\[optionlay\]** you can configure **"01-extractPageslist.php"** & **"02-getDownloadsList.php"** as you want
3. run file **"01-extractPageslist.php"** first then wait until save your links in this file **"wallpaperPagesList.txt"**
4. then run file **"02-getDownloadsList.php"** and wait until save your links in this file **"wallpaperDownloadsList.txt"**

Congratulations visit file : **"wallpaperDownloadsList.txt"** and add results to your download manager

## Notice
please increase this value at **"php.ini"** in the root of php installed directory 

        max_execution_time=21000

warning: 21000 secound for downloading complately all possible image in this site.
complate Downloading.
this is take **minimum 3 houer** and **maximum is 6 Hour**

we recommend set time for each link 3 secound

### Example 
100 link * 3 secound

        max_execution_time=300

