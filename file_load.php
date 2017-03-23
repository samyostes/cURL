<?php
//this functon downloads content from a webserver
function downloadContent($url,$filename){

 //file on the server...file created if doesn't exist
 $file = $filename.".html";


 
$curlInit = curl_init();
 
//open file for writng
$fHandle = fopen($file, "w");
 
//set the url to a string
curl_setopt_array($curlInit,
  array(
    CURLOPT_URL    => $url,
    CURLOPT_FILE   => $fHandle,
    CURLOPT_HEADER => true
  )
);
 

$data = curl_exec($curlInit);

 //get information about the last transfer
$response   = curl_getinfo($curlInit, CURLINFO_HTTP_CODE);

//get the length of downloaded file 
$downloadLen = curl_getinfo($curlInit, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
 
 //check if there is error during download;
if(curl_errno($curlInit))
{
  print curl_error($curlInit);
}
else
{
  //if no error show success message
  if($response == "200") echo "success!!!<br>";
    
  echo " file length : " . $downloadLen;
  echo "<br>file '".$file."' was created check contents here : <a href='".$file."'/>view file</a>";

 
  curl_close($curlInit);
 
  fclose($fHandle);
}

}

//download content from a site

downloadContent("http://www.eastoftheweb.com/short-stories/UBooks/JereMagi942.shtml", "test");
?>

