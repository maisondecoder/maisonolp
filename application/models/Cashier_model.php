<?php

class Cashier_model extends CI_Model
{

    //Cashier Login
    public function login_verify($email_input, $pass_input)
    {
        $this->db->select('*');
        $cashier = $this->db->get_where('cd_cashier_data', array('cas_email' => $email_input), 1, 0)->row_array();
        if ($cashier) {
            if (password_verify($pass_input, $cashier['cas_password'])) {
                $this->load->helper('date');
                $data = array(
                    'date_last_login' => now(),
                );
                $this->db->where('cas_email', $email_input);
                $this->db->update('cd_cashier_data', $data);
                return $cashier;
            } else {
                //Password not match
                return false;
            }
        } else {
            //User not match
            return false;
        }
    }

    public function get_cashier_profile($cas_email_input)
    {
        $this->db->select('a.cas_id, a.cas_fullname, a.cas_email, a.store_id, b.store_name');
        $this->db->join('sd_store_data b', 'b.store_id = a.store_id');
        $get_cashier_profile = $this->db->get_where('cd_cashier_data a', array('a.cas_email' => $cas_email_input), 1, 0)->row_array();

        return $get_cashier_profile;
    }

    //membuat record transaksi
    public function create_trx($trx_reff_input, $nominal_input, $note_input, $status_input, $store_id_input, $cus_id_input, $jurnal_input, $cas_id_input, $pts_multi_input)
    {
        $this->load->helper('date');

        $reff = $trx_reff_input;
        $nominal = $nominal_input;
        $note = $note_input;
        $status = $status_input;
        $store_id = $store_id_input;
        $cus_id = $cus_id_input;
        $jurnal = $jurnal_input;
        $cas_id = $cas_id_input;
        $pts_multi = $pts_multi_input;
        $end_year = strtotime('31 December ' . (date('Y') + 1) . ' 23:59:59 GMT+07:00');

        $data = array(
            'trx_reff' => $reff,
            'trx_nominal' => $nominal,
            'trx_note' => $note,
            'trx_status' => $status,
            'store_id' => $store_id,
            'cus_id' => $cus_id,
            'jurnal_id' => $jurnal,
            'cas_id' => $cas_id,
            'date_created' => now(),
            'pts_multiplier' => $pts_multi,
            'date_expired' => $end_year
        );

        $this->db->insert('trx_transaction', $data);
    }

    //menambah record mutasi point
    public function create_pts($nominal_input, $type_input, $note_input, $cus_id_input, $pts_status_input, $trx_reff_input)
    {
            $this->load->helper('date');

            $nominal = $nominal_input;
            $type = $type_input;
            $note = $note_input;
            $cus_id = $cus_id_input;
            $status = $pts_status_input;
            $trx_reff = $trx_reff_input;
            $end_year = strtotime('31 December ' . (date('Y') + 1) . ' 23:59:59 GMT+07:00');

            $data = array(
                'pts_nominal' => $nominal,
                'pts_type' => $type,
                'pts_note' => $note,
                'pts_status' => $status,
                'cus_id' => $cus_id,
                'trx_reff' => $trx_reff,
                'date_created' => now(),
                'date_expired' => $end_year
            );

            $this->db->insert('pts_point', $data);
    }

    public function change_password($cas_email_input, $cas_new_password_input)
    {
        $data = array(
            'cas_password' => $cas_new_password_input,
        );

        $this->db->where('cas_email', $cas_email_input);
        $change_password = $this->db->update('cd_cashier_data', $data);

        return $change_password;
    }

    //Scan Voucher QR
    public function scan_voucher($hash_input)
    {
        $this->db->select('vou_voucher_user.vop_uniqueid, vp_voucher_program.vop_image, vp_voucher_program.vop_title, vou_voucher_user.vou_reff, vou_voucher_user.date_expired, vou_voucher_user.date_used');
        $this->db->join('vp_voucher_program', 'vp_voucher_program.vop_uniqueid = vou_voucher_user.vop_uniqueid');
        $find_cus = $this->db->get_where('vou_voucher_user', array('vou_voucher_user.vou_reff' => $hash_input, 'vou_voucher_user.date_expired >=' => now(), 'vou_voucher_user.date_used <=' => 0), 1, 0)->row_array();

        return $find_cus;
    }

    //Scan Member QR
    public function scan_qrid($hash_input)
    {
        $this->db->select('cd_customer_data.cus_id, cus_hash, profile_first_name, profile_last_name');
        $this->db->join('cp_customer_profile', 'cp_customer_profile.cus_id = cd_customer_data.cus_id');
        $this->db->order_by('cus_id', 'DESC');
        $find_vou = $this->db->get_where('cd_customer_data', array('cus_hash' => $hash_input), 1, 0)->row_array();

        return $find_vou;
    }

    public function claim_voucher($reff_input)
    {
        $this->load->helper('date');

        $data = array(
            'date_used' => now(),
        );

        $this->db->where('vou_reff', $reff_input);
        $this->db->where('date_expired >=', now());
        $this->db->where('date_used <=', 1);
        $this->db->update('vou_voucher_user', $data);
        $claim =  $this->db->affected_rows();

        return $claim;
    }

    //////////////////////////////////////////////////////////////
    //////////////// AUTH, RESET, FORGOT PASSWORD ////////////////
    //////////////////////////////////////////////////////////////

    public function cashier_create_token_reset($cashier_id)
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
            'cas_id' => $cashier_id
        );

        $this->db->insert('reset_password_cashier', $data);

        return $randomString;
    }

    public function cashier_check_token_reset($token_reset)
    {
        $this->load->helper('date');

        $this->db->select('*');
        $this->db->where('reset_token',  $token_reset);
        $this->db->where('date_expired >',  now());
        $this->db->limit(1);
        $existing = $this->db->get('reset_password_cashier')->row_array();
        if ($existing) {
            return $existing;
        } else {
            return false;
        }
    }

    public function cashier_change_password($pass_input, $cas_id_input)
    {
        $pass_hash = password_hash($pass_input, PASSWORD_DEFAULT);

        $data = array(
            'cas_password' => $pass_hash
        );

        $this->db->where('cas_id', $cas_id_input);
        $change_password = $this->db->update('cd_cashier_data', $data);

        return $change_password;
    }
}
