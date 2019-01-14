<?php


$url = $_GET['c'];

$filename = "/tmp/download.pdf";

exec("wkhtmltopdf $url $filename");

$dowloadname = 'PHPDownload.pdf';
Header("content-type:application/octet-stream"); 
Header("Accept-Ranges: bytes");
Header("Accept-Length: ".filesize($filename));
Header("Content-Disposition: attachment; filename=".$dowloadname);
if(file_exists($filename) && $fp=fopen($filename,"r"))  //file exists and open it 
{ 
    echo fread($fp,filesize($filename));    //read write to the browser 
    fclose($fp); 
}

