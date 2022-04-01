<?php

class Customer_model extends CI_Model
{

    public function cus_status($phone_input)
    {
        $this->db->select('cus_status, is_verified, is_profiled');
        $cus_status = $this->db->get_where('cd_customer_data', array('cus_phone' => $phone_input), 1, 0)->row_array();

        if($cus_status){
            return $cus_status;
        }else{
            $cus_status = array(
                'is_verified' => 0,
                'is_profiled' => 0,
            );

            return $cus_status;
        }
    }

    //Customer Login
    public function login_verify($phone_input, $pass_input)
    {
        $this->db->select('*');
        $customer = $this->db->get_where('cd_customer_data', array('cus_phone' => $phone_input), 1, 0)->row_array();
        if ($customer) {
            if (password_verify($pass_input, $customer['cus_pass'])) {
                $this->load->helper('date');
                $data = array(
                    'date_last_login' => now(),
                );
                $this->db->where('cus_phone', $phone_input);
                $this->db->update('cd_customer_data', $data);

                return $customer;
            } else {
                //Password not match
                return false;
            }
        } else {
            //User not match
            return false;
        }
    }

    //fungsi memanggil data customer
    public function find_cus($phone_input)
    {
        $this->db->select('*');
        $this->db->order_by('cus_id', 'DESC');
        $find_cus = $this->db->get_where('cd_customer_data', array('cus_phone' => $phone_input), 1, 0)->row_array();

        return $find_cus;
    }
    public function find_cus_by_hash($hash_input)
    {
        $this->db->select('*');
        $this->db->order_by('cus_id', 'DESC');
        $find_cus_by_hash = $this->db->get_where('cd_customer_data', array('cus_hash' => $hash_input), 1, 0)->row_array();

        return $find_cus_by_hash;
    }

    //memanggil total transaksi (teraudit) customer
    public function get_count_cus_trx($cus_id_input)
    {
        $this->load->helper('date');
        $this->db->select('trx_id');
        $total_trx = $this->db->get_where('trx_transaction', array('cus_id' => $cus_id_input, 'trx_status' => 1, 'date_expired >=' => now()), 0, 0)->result_array();

        return count($total_trx);
    }

    //memanggil total transaksi (pending) customer
    public function get_count_cus_trx_pending($cus_id_input)
    {
        $this->load->helper('date');
        $this->db->select('trx_id');
        $total_trx = $this->db->get_where('trx_transaction', array('cus_id' => $cus_id_input, 'trx_status' => 0, 'date_expired >=' => now()), 0, 0)->result_array();

        return count($total_trx);
    }

    //memanggil semua list transaksi customer
    public function get_list_cus_trx($cus_id_input)
    {
        $this->load->helper('date');
        $this->db->select('*');
        $this->db->order_by('date_created', 'DESC');
        $get_list_cus_trx = $this->db->get_where('trx_transaction', array('cus_id' => $cus_id_input, 'date_expired >=' => now()), 0, 0)->result_array();

        return $get_list_cus_trx;
    }

    //memanggil semua list point customer
    public function get_list_cus_pts($cus_id_input)
    {
        $this->load->helper('date');
        $this->db->select('*');
        $this->db->order_by('date_created', 'DESC');
        $get_list_cus_pts = $this->db->get_where('pts_point', array('cus_id' => $cus_id_input, 'date_expired >=' => now()), 0, 0)->result_array();

        return $get_list_cus_pts;
    }

    public function get_count_cus_pts_audited($cus_id_input)
    {
        $this->load->helper('date');
        $this->db->select('pts_id');
        $get_count_cus_pts_audited = $this->db->get_where('pts_point', array('cus_id' => $cus_id_input,'pts_status' => 1, 'date_expired >=' => now()), 0, 0)->result_array();

        return count($get_count_cus_pts_audited);
    }

    public function get_count_cus_pts_pending($cus_id_input)
    {
        $this->load->helper('date');
        $this->db->select('pts_id');
        $get_count_cus_pts_pending = $this->db->get_where('pts_point', array('cus_id' => $cus_id_input,'pts_status' => 0, 'date_expired >=' => now()), 0, 0)->result_array();

        return count($get_count_cus_pts_pending);
    }

    //memanggil id customer
    public function get_cus_id($phone_input)
    {
        $this->db->select('cus_id');
        $get_cus_id = $this->db->get_where('cd_customer_data', array('cus_phone' => $phone_input), 1, 0)->row_array();

        return $get_cus_id['cus_id'];
    }

    //memanggil profile customer
    public function get_cus_profile($cus_id)
    {
        $this->db->select('a.profile_first_name, a.profile_last_name, b.gender_label, c.age_label');
        $this->db->from('cp_customer_profile a');
        $this->db->join('master_gender b', 'b.gender_id = a.gender_id');
        $this->db->join('master_age_group c', 'c.age_id = a.age_id');
        $get_profile = $this->db->get_where('cp_customer_profile', array('a.cus_id' => $cus_id), 1, 0)->row_array();

        return $get_profile;
    }

    //memanggil total belanja customer
    public function get_total_spending($cus_id_input)
    {
        $this->load->helper('date');
        $this->db->select_sum('trx_nominal');
        $spending = $this->db->get_where('trx_transaction', array('cus_id' => $cus_id_input, 'trx_status' => 1, 'date_expired >=' => now()), 0, 0)->row_array();

        if ($spending['trx_nominal']) {
            return $spending['trx_nominal'];
        } else {
            return 0;
        }
    }

    //memanggil level customer
    public function get_level($total_spending)
    {

        $this->db->select('ml_name, ml_range_min, ml_range_max');
        $level = $this->db->get_where('ml_member_level', array('ml_range_min <=' => $total_spending, 'ml_range_max >=' => $total_spending), 0, 0)->row_array();

        return $level;
    }

    //memanggil sisa point customer
    public function get_point_balance($cus_id_input)
    {
        $this->load->helper('date');
        $this->db->select_sum('pts_nominal');
        $credits = $this->db->get_where('pts_point', array('cus_id' => $cus_id_input, 'pts_type' => 0, 'pts_status' => 1, 'date_expired >=' => now()), 0, 0)->row_array();
        if ($credits) {
            $credits = $credits['pts_nominal'];
        } else {
            $credits = 0;
        }
        $this->db->select_sum('pts_nominal');
        $debits = $this->db->get_where('pts_point', array('cus_id' => $cus_id_input, 'pts_type' => 1, 'pts_status' => 1, 'date_expired >=' => now()), 0, 0)->row_array();
        if ($debits) {
            $debits = $debits['pts_nominal'];
        } else {
            $debits = 0;
        }

        return $credits - $debits;
    }

}
