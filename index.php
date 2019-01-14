<?php

function get_title($url){
  $str = file_get_contents($url);
  if(strlen($str)>0){
    $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
    preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
    return $title[1];
  }
}

if ($_GET['c'] || !empty($_GET['c'])){

 $url = $_GET['c'];
  $title = get_title($url);
  $filename = "/tmp/exportPDF.pdf";

  exec("wkhtmltopdf $url $filename");

  $dowloadname = $title . '.pdf';
  Header("content-type:application/octet-stream"); 
  Header("Accept-Ranges: bytes");
  Header("Accept-Length: ".filesize($filename));
  Header("Content-Disposition: attachment; filename=".$dowloadname);
  if(file_exists($filename) && $fp=fopen($filename,"r")){ 
    echo fread($fp,filesize($filename));    //read write to the browser 
    fclose($fp); 
  }
}else{

?>

<html>
<head>
  <title>CodiMD Exporter</title>
</head>

<body>
<form action="" method="GET">
  <label> Please Input CodiMD publish url</label>
  <input type="text" name="c">
  <input type="submit" value="Export">
</form>
</body>

</html>



<?php }

unlink($filename);

 ?>
