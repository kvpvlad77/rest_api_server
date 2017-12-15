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

$service_url = 'http://localhost:81/api/users/cid123=qwerty&status=292929';
$ch = curl_init($service_url);
 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
$data = array("a" => "1", "b" => "2", "c" => "3", "d" => "4", "e" =>"345");
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
$response = curl_exec($ch);
if ($response === false) {
    $info = curl_getinfo($ch);
    curl_close($ch);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($ch);
$decoded = json_decode($response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
echo 'response ok!';
//var_export($decoded->response);
 //var_dump($decoded);
 
 
$service_url = 'http://localhost:81/api/users';
$curl = curl_init($service_url);
$curl_post_data = array(
        'message' => 'test message',
        'useridentifier' => 'agent@example.com',
        'department' => 'departmentId001',
        'subject' => 'My first conversation',
        'recipient' => 'recipient@example.com',
        'apikey' => 'key001'
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
echo 'response ok!';
//var_export($decoded->response);
 var_dump($curl_response);
 
?>