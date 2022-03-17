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
        $this->db->select('a.cas_fullname, a.cas_email, a.store_id, b.store_name');
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
        $end_year = strtotime('31 December ' . (date('Y')+1) . ' 23:59:59 GMT+07:00'); 

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
        $end_year = strtotime('31 December ' . (date('Y')+1) . ' 23:59:59 GMT+07:00');

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


    public function scan_qrid($hash_input)
    {
        $this->db->select('*');
        $this->db->order_by('cus_id', 'DESC');
        $find_cus = $this->db->get_where('cd_customer_data', array('cus_hash' => $hash_input), 1, 0)->row_array();

        return $find_cus;
    }
}
