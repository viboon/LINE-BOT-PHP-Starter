<?php
 
$strAccessToken = "y9nQ4AJE1/MlRsVH5zrIlqbQ1ISgjZiEO0IEls93E6jvh29b/s43h1L1HDzUR1TnMBUtA24Wrj33ahADvS3l7PRTukKGQzNuXv24O51ZwNLz0HPnNMFO2pDUrw2Pe+DYIWUwzfvLWrjx5M47+/AfjAdB04t89/1O/w1cDnyilFU=";
 
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
 
$strUrl = "https://api.line.me/v2/bot/message/reply";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 
if($arrJson['events'][0]['message']['text'] == "hi"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "สวัสดี ID คุณคือ ".$arrJson['events'][0]['source']['userId'];
  sendUserID("User Name: ".$arrJson['events'][0]['source']['name']."\n New UserID: ".$arrJson['events'][0]['source']['userId']);
}else if($arrJson['events'][0]['message']['text'] == "ชื่ออะไร"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ฉันยังไม่มีชื่อนะ";
}else if($arrJson['events'][0]['message']['text'] == "ทำอะไรได้บ้าง"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ฉันทำอะไรไม่ได้เลย คุณต้องสอนฉันอีกเยอะ";
}else{
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ฉันไม่เข้าใจคำสั่ง";
}
 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
//curl_setopt($ch, CURLOPT_PROXY, '10.4.3.240:80');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);

function sendUserID($message)
{ 
$strAccessToken = "y9nQ4AJE1/MlRsVH5zrIlqbQ1ISgjZiEO0IEls93E6jvh29b/s43h1L1HDzUR1TnMBUtA24Wrj33ahADvS3l7PRTukKGQzNuXv24O51ZwNLz0HPnNMFO2pDUrw2Pe+DYIWUwzfvLWrjx5M47+/AfjAdB04t89/1O/w1cDnyilFU="; 
$strUrl = "https://api.line.me/v2/bot/message/push";
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}"; 
$arrPostData = array();
$arrPostData['to'] = "Ub8713cd9b2b9506f5842b204b239bbde";
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = $message;
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
$result = curl_exec($ch);
curl_close ($ch);

}

?>
