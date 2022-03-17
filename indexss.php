<?php
/**
 * Send a message via SendTalk.
 *
 * @param  string   $api_key      API key from SendTalk.
 * @param  string   $phone        Recipient's phone number (must start with country code).
 * @param  string   $message_type The message type ("otp", "text", or "image").
 * @param  string   $body         The message body (text message or file URL for image).
 * @param  string   $filename     Optional. The name of the file (required for message type "image").
 * @param  string   $caption      Optional. The caption, if any (for message type "image").
 * @return response
 */
$apikey = '7cbd93ca4421586689e741eb9d42a0e69a5524752e01781cc9693489082bb393';
function sendTalkSendMessage($api_key, $phone, $message_type, $body, $filename, $caption) {
  $curl = curl_init();
  
  $data = [
    'phone'       => $phone,
    'messageType' => $message_type,
    'body'        => $body
  ];
  if ($message_type != 'text' && $message_type != 'otp') {
    $data['filename'] = $filename;
    $data['caption']  = $caption;
  }

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://sendtalk-api.taptalk.io/api/v1/message/send_whatsapp',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
      'API-Key: ' . $api_key,
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  return $response;
}

sendTalkSendMessage($apikey, '6281325389241', 'otp', 'Masukan kode OTP kamu ke website Maison Living, OTP Kamu adalah: 888999',null,null);