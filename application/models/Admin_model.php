<?php

class Admin_model extends CI_Model
{

    //Verifikasi login
    public function login_verify($email_input, $pass_input)
    {
        $this->db->select('*');
        $admin = $this->db->get_where('ad_admin_data', array('admin_email' => $email_input), 1, 0)->row_array();
        if ($admin) {
            if (password_verify($pass_input, $admin['admin_pass'])) {
                $this->load->helper('date');
                $data = array(
                    'date_last_login' => now(),
                );
                $this->db->where('admin_email', $email_input);
                $this->db->update('ad_admin_data', $data);
                return $admin;
            } else {
                //Password not match
                return false;
            }
        } else {
            //User not match
            return false;
        }
    }

    public function change_password($cas_email_input, $cas_new_password_input)
    {
        $data = array(
            'admin_pass' => $cas_new_password_input,
        );

        $this->db->where('admin_email', $cas_email_input);
        $change_password = $this->db->update('ad_admin_data', $data);

        return $change_password;
    }

    //Pending Review Transaksi
    public function get_one_transaction($trx_reff_input)
    {
        $this->db->select('*');
        $this->db->from('trx_transaction');
        $this->db->join('sd_store_data', 'sd_store_data.store_id = trx_transaction.store_id');
        $this->db->join('cd_cashier_data', 'cd_cashier_data.cas_id = trx_transaction.cas_id');
        $this->db->join('cd_customer_data', 'cd_customer_data.cus_id = trx_transaction.cus_id');
        $this->db->join('cp_customer_profile', 'cp_customer_profile.cus_id = trx_transaction.cus_id');
        $this->db->join('pts_point', 'pts_point.trx_reff = trx_transaction.trx_reff');
        $this->db->order_by('trx_transaction.date_created', 'ASC');
        $this->db->where('trx_status', 0);
        $this->db->where('trx_transaction.trx_reff', $trx_reff_input);
        $trx_list = $this->db->get()->row_array();

        return $trx_list;
    }

    //semua Transaksi
    public function get_all_transactions()
    {
        $this->db->select('*');
        $this->db->from('trx_transaction');
        $this->db->join('sd_store_data', 'sd_store_data.store_id = trx_transaction.store_id');
        $this->db->join('cd_cashier_data', 'cd_cashier_data.cas_id = trx_transaction.cas_id');
        $this->db->join('cd_customer_data', 'cd_customer_data.cus_id = trx_transaction.cus_id');
        $this->db->join('cp_customer_profile', 'cp_customer_profile.cus_id = trx_transaction.cus_id');
        $this->db->join('ad_admin_data', 'ad_admin_data.admin_id = trx_transaction.admin_id');
        $this->db->join('pts_point', 'pts_point.trx_reff = trx_transaction.trx_reff');
        $this->db->order_by('trx_transaction.date_created', 'ASC');
        $trx_list = $this->db->get()->result_array();

        return $trx_list;
    }

    //Pending Review Transaksi
    public function get_all_pending_transactions($branch = 0)
    {
        $this->db->select('*');
        $this->db->from('trx_transaction');
        $this->db->join('sd_store_data', 'sd_store_data.store_id = trx_transaction.store_id');
        $this->db->join('cd_cashier_data', 'cd_cashier_data.cas_id = trx_transaction.cas_id');
        $this->db->join('cd_customer_data', 'cd_customer_data.cus_id = trx_transaction.cus_id');
        $this->db->join('cp_customer_profile', 'cp_customer_profile.cus_id = trx_transaction.cus_id');
        $this->db->join('pts_point', 'pts_point.trx_reff = trx_transaction.trx_reff');
        $this->db->order_by('trx_transaction.date_created', 'ASC');
        $this->db->where('trx_status', 0);
        if($branch > 0){
            $this->db->where('trx_transaction.store_id', $branch);
        }
        $trx_list = $this->db->get()->result_array();

        return $trx_list;
    }

    //Approved Review Transaksi
    public function get_all_approved_transactions($branch = 0)
    {
        $this->db->select('*');
        $this->db->from('trx_transaction');
        $this->db->join('sd_store_data', 'sd_store_data.store_id = trx_transaction.store_id');
        $this->db->join('cd_cashier_data', 'cd_cashier_data.cas_id = trx_transaction.cas_id');
        $this->db->join('cd_customer_data', 'cd_customer_data.cus_id = trx_transaction.cus_id');
        $this->db->join('cp_customer_profile', 'cp_customer_profile.cus_id = trx_transaction.cus_id');
        $this->db->join('ad_admin_data', 'ad_admin_data.admin_id = trx_transaction.admin_id');
        $this->db->join('pts_point', 'pts_point.trx_reff = trx_transaction.trx_reff');
        $this->db->order_by('trx_transaction.date_approved', 'DESC');
        $this->db->where('trx_status', 1);
        if($branch > 0){
            $this->db->where('trx_transaction.store_id', $branch);
        }
        $trx_list = $this->db->get()->result_array();

        return $trx_list;
    }

    public function get_stores(){
        $this->db->select('*');
        $this->db->from('sd_store_data');
        $stores = $this->db->get()->result_array();

        return $stores;
    }

    public function check_pending_trx($trx_id)
    {
        $this->db->select('trx_id');
        $this->db->from('trx_transaction');
        $this->db->where('trx_id', $trx_id);
        $this->db->where('trx_status', 0);
        $pending_trx = $this->db->get()->row_array();

        return $pending_trx;
    }

    //Approving Transaksi
    public function approve($trx_id_input = '0', $trx_reff_input = '0')
    {
        if ($trx_id_input == '0' || $trx_reff_input == '0') {
            return 'parameter invalid';
            die();
        }
        $this->load->helper('date');
        $this->db->set('trx_status', 1);
        $this->db->set('admin_id', $this->session->userdata('ses_admin_id'));
        $this->db->set('date_approved', now());
        $this->db->where('trx_id', $trx_id_input);
        $update_trx = $this->db->update('trx_transaction');

        if ($update_trx) {
            $this->db->set('pts_status', 1);
            $this->db->where('trx_reff', $trx_reff_input);
            $update_pts = $this->db->update('pts_point');
            return $update_pts;
        } else {
            return false;
        }
    }

    //All Registered Members
    public function get_all_members($status_input)
    {
        $this->db->select('*');
        $this->db->from('cd_customer_data');
        $this->db->join('cp_customer_profile', 'cp_customer_profile.cus_id = cd_customer_data.cus_id');
        $this->db->join('master_celebrate', 'master_celebrate.celebrate_id = cp_customer_profile.celebrate_id');
        $this->db->order_by('date_created', 'DESC');
        $this->db->where('cus_status', $status_input);
        $member_list = $this->db->get()->result_array();

        return $member_list;
    }

    //All Registered Members
    public function get_filtered_members($status_input)
    {
        $this->db->select('*');
        $this->db->from('cd_customer_data');
        $this->db->join('cp_customer_profile', 'cp_customer_profile.cus_id = cd_customer_data.cus_id');
        $this->db->join('master_celebrate', 'master_celebrate.celebrate_id = cp_customer_profile.celebrate_id');
        $this->db->order_by('date_created', 'DESC');
        $this->db->where('cus_status', $status_input);
        $member_list = $this->db->get()->result_array();

        return $member_list;
    }

    //All Registered Members
    public function get_all_cashiers($status_input)
    {
        $this->db->select('*');
        $this->db->from('cd_cashier_data');
        $this->db->join('sd_store_data', 'sd_store_data.store_id = cd_cashier_data.store_id');
        $this->db->order_by('cd_cashier_data.date_created', 'DESC');
        $this->db->where('cas_status', $status_input);
        $cashier_list = $this->db->get()->result_array();

        return $cashier_list;
    }

    //All Registered Members
    public function get_point_settings()
    {
        $this->db->select('*');
        $this->db->from('ps_point_settings');
        $point_settings = $this->db->get()->row_array();

        return $point_settings;
    }

    //Approving Transaksi
    public function set_point_settings($ps_value = 1000000, $ps_multi = 1)
    {
        if ($ps_value < 1000000 || $ps_multi < 1) {
            return 'parameter invalid';
            die();
        }

        $this->db->set('ps_point_per', $ps_value);
        $this->db->set('ps_point_multiplier', $ps_multi);
        $update_ps = $this->db->update('ps_point_settings');

        return $update_ps;
    }

    

    //Ambil data transaksi
    public function edit_trx_nominal($trx_reff, $trx_nominal, $pts_per, $multiplier)
    {
        $this->db->set('trx_nominal', $trx_nominal);
        $this->db->where('trx_reff', $trx_reff);
        $update_trx = $this->db->update('trx_transaction');
        if ($update_trx) {
            $this->load->model('websetting_model');
            
            $pts_nominal = $trx_nominal / $pts_per * $multiplier;
            $this->db->set('pts_nominal', $pts_nominal);
            $this->db->where('trx_reff', $trx_reff);
            $update_pts = $this->db->update('pts_point');
            if ($update_pts) {
                return true;
            } else {
                //update pts gagal
                return false;
            }
        } else {
            //update trx gagal
            return false;
        }
    }

    //Add New Voucher Program
    public function add_voucher_program($title,$desc,$quota,$limit,$price,$start,$end,$unique,$image){

        $data = array(
            'vop_title' => $title,
            'vop_uniqueid' => $unique,
            'vop_desc' => $desc,
            'vop_maxpuser' => $limit,
            'vop_maxquota' => $quota,
            'vop_image' => $image,
            'vop_pointprice' => $price,
            'date_created' => now(),
            'date_start' => $start,
            'date_end' => $end
        );

        $add = $this->db->insert('vp_voucher_program', $data);
        return $add;
    }

    public function edit_voucher_program($title,$desc,$quota,$limit,$price,$start,$end,$unique,$image){

        $data = array(
            'vop_title' => $title,
            'vop_desc' => $desc,
            'vop_maxpuser' => $limit,
            'vop_maxquota' => $quota,
            'vop_image' => $image,
            'vop_pointprice' => $price,
            'date_created' => now(),
            'date_start' => $start,
            'date_end' => $end
        );
        $this->db->where('vop_uniqueid', $unique);
        $this->db->update('vp_voucher_program', $data);
        $edit = $this->db->affected_rows();
        return $edit;
    }

    //Get Specific Voucher Program
    public function specific_voucher_program($uniqueid){
        $this->db->select('*');
        $this->db->from('vp_voucher_program');
        $this->db->where('vop_uniqueid', $uniqueid);
        $specific_voucher_program = $this->db->get()->row_array();

        return $specific_voucher_program;
    }

    //All Registered Members
    public function all_voucher_program()
    {
        $this->db->select('*');
        $this->db->from('vp_voucher_program');
        $this->db->order_by('date_created', 'DESC');
        $all_voucher_program = $this->db->get()->result_array();

        return $all_voucher_program;
    }

    public function delete_voucher_program($uniqueid){
        $this->db->delete('vp_voucher_program', array('vop_uniqueid' => $uniqueid));
        
        $delete = $this->db->affected_rows();
        return $delete;
    }
}
