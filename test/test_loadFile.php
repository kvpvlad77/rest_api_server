<?PHP



$url = 'http://localhost:81/api/userphoto';
$file = 'c:\Users\kvp\Pictures\2.jpg';
$fp = fopen($file, 'r');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url . '/name=' . urlencode('ivan') . '&message=' . urlencode('imagenrr'));
curl_setopt($ch, CURLOPT_INFILE, $fp);
curl_setopt($ch, CURLOPT_INFILESIZE, filesize($file));
curl_setopt($ch, CURLOPT_PUT, 1);
curl_setopt($ch, CURLOPT_UPLOAD, 1);
curl_exec($ch);
curl_close($ch);


 
?>