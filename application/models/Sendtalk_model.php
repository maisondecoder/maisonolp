<?php

class Sendtalk_model extends CI_Model {

    public function send_otp($phone_input)
    {
        $this->load->helper('date');

        $kode = rand(1111, 9999);
        $api_key = "7cbd93ca4421586689e741eb9d42a0e69a5524752e01781cc9693489082bb393";
        $phone = $phone_input; 
        $message_type = "otp"; 
        $body = "Kode OTP Anda = ".$kode.", hanya berlaku untuk 5 menit.\n\n-----------------------\n_Jangan beritahu siapapun._\n_(Pesan Otomatis)._\n-----------------------\n\nMaison Living Website";
        $filename = null; 
        $caption = null;
        
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

        $data = array(
            'otp_requestor' => $phone,
            'otp_code' => $kode,
            'date_created' => now(),
            'date_expired' => now()+300
        );
    
        $this->db->insert('otp_request', $data);

        return $response;
    }

}

?>