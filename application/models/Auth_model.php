<?php

class Auth_model extends CI_Model
{

    //fungsi cek apakah existing member atau bukan
    public function check_existing_member($phone_input)
    {
        $this->load->helper('date');

        $this->db->select('cus_id, is_verified');
        $this->db->where('cus_phone',  $phone_input);
        $this->db->where('is_verified', 1);
        $this->db->limit(1);
        $existing = $this->db->get('cd_customer_data')->row_array();
        if ($existing) {
            return true;
        } else {
            return false;
        }
    }


    //fungsi cek masa berlaku otp terakhir nomor tertentu
    public function check_latest_otp($phone_input)
    {
        $this->load->helper('date');

        $this->db->select('*');
        $this->db->order_by('otp_id', 'DESC');
        $this->db->where('otp_requestor',  $phone_input);
        $this->db->limit(1);
        $latest = $this->db->get('otp_request')->row_array();
        //print_r($latest);
        if ($latest) {
            if ($latest['date_created'] <= now() && $latest['date_expired'] >= now()) {
                echo 'latest OTP belum expired';
                return true;
            } else {
                echo 'latest OTP expired';
                return false;
            }
        } else {
            echo 'tidak ditemukan latest OTP';
            return false;
        }
    }

    //fungsi verifikasi otp dengan nomor wa apakah cocok/valid
    public function verify_otp($phone_input, $otp_input)
    {
        $this->load->helper('date');

        $this->db->select('*');
        $this->db->order_by('otp_id', 'DESC');
        $this->db->where('otp_requestor',  $phone_input);
        $this->db->limit(1);
        $latest = $this->db->get('otp_request')->row_array();
        print_r($latest);
        if ($latest) {
            if ($latest['date_created'] <= now() && $latest['date_expired'] >= now()) {
                if ($latest['otp_requestor'] == $phone_input && $latest['otp_code'] == $otp_input) {
                    //echo 'OTP belum expired & cocok';
                    $data = array(
                        'is_verified' => 1,
                    );
                    $this->db->where('cus_phone', $phone_input);
                    $this->db->update('cd_customer_data', $data);
                    return true; //kalau otp belum expired dan no.wa + otp cocok, maka true
                } else {
                    //echo 'OTP belum expired, tidak cocok';
                    return false; //kalau otp belum expired, tapi no.wa + otp tidak cocok, maka false
                }
            } else {
                //echo 'OTP expired';
                return false; //kalau otp terakhir sudah expired, maka false
            }
        } else {
            //echo 'tidak ditemukan latest OTP';
            return false; //kalau di db tidak ada otp, maka false
        }
    }

    public function auth_create_password($email_input, $phone_input, $pass_input)
    {
        $this->load->helper('date');

        $data = array(
            'cus_email' => $email_input,
            'cus_phone' => $phone_input,
            'cus_hash' => md5($email_input . $phone_input . now()),
            'cus_pass' => $pass_input,
            'cus_status' => 1,
            'is_verified' => 1,
            'date_created' => now()
        );

        $this->db->insert('cd_customer_data', $data);
    }

    //fungsi menyimpan data member saat pertama kali login
    public function auth_create_profile($first_input, $last_input, $gender_input, $age_input, $cus_id)
    {
        $this->load->helper('date');

        $data = array(
            'cus_id' => $cus_id,
            'profile_first_name' => $first_input,
            'profile_last_name' => $last_input,
            'gender_id' => $gender_input,
            'age_id' => $age_input,
        );

        $this->db->insert('cp_customer_profile', $data);

        $data = array(
            'is_profiled' => 1,
        );
        $this->db->where('cus_id', $cus_id);
        $this->db->update('cd_customer_data', $data);
    }

    public function auth_check_account_forgot($phone_input, $email_input)
    {
        $this->load->helper('date');

        $this->db->select('cus_id, cus_phone, cus_email');
        $this->db->where('cus_phone',  $phone_input);
        $this->db->where('cus_email',  $email_input);
        $this->db->limit(1);
        $existing = $this->db->get('cd_customer_data')->row_array();
        if ($existing) {
            return $existing['cus_id'];
        } else {
            return false;
        }
    }

    public function auth_create_token_reset($user_id)
    {
        $this->load->helper('date');

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 12; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    
        $data = array(
            'reset_token' => $randomString,
            'date_created' => now(),
            'date_expired' => now() + 300,
            'cus_id' => $user_id
        );

        $this->db->insert('reset_password_request', $data);

        return $randomString;
    }

    public function auth_check_token_reset($token_reset)
    {
        $this->load->helper('date');

        $this->db->select('*');
        $this->db->where('reset_token',  $token_reset);
        $this->db->where('date_expired >',  now());
        $this->db->limit(1);
        $existing = $this->db->get('reset_password_request')->row_array();
        if ($existing) {
            return $existing;
        } else {
            return false;
        }
    }

    public function auth_change_password($pass_input, $cus_id_input)
    {
        $pass_hash = password_hash($pass_input, PASSWORD_DEFAULT);

        $data = array(
            'cus_pass' => $pass_hash
        );

        $this->db->where('cus_id', $cus_id_input);
        $change_password = $this->db->update('cd_customer_data', $data);

        return $change_password;
    }
}
