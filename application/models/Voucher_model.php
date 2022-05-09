<?php

class Voucher_model extends CI_Model
{

    //memanggil semua list voucher program
    public function get_list_active_voucher_program($now)
    {
        $this->db->select('*');
        $this->db->order_by('date_end', 'ASC');
        $get_list_active_vp = $this->db->get_where('vp_voucher_program', array('date_start <=' => $now, 'date_end >=' => $now), 0, 0)->result_array();

        return $get_list_active_vp;
    }

    public function get_list_upcoming_voucher_program($now)
    {
        $this->db->select('*');
        $this->db->order_by('date_start', 'ASC');
        $get_list_active_vp = $this->db->get_where('vp_voucher_program', array('date_start >' => $now), 0, 0)->result_array();

        return $get_list_active_vp;
    }

    public function get_list_expired_voucher_program($now)
    {
        $this->db->select('*');
        $this->db->order_by('date_end', 'DESC');
        $get_list_active_vp = $this->db->get_where('vp_voucher_program', array('date_end <' => $now), 0, 0)->result_array();

        return $get_list_active_vp;
    }

    public function get_voucher_program_details($vop_uniqueid_input)
    {
        $this->db->select('*');
        $get_list_active_vp = $this->db->get_where('vp_voucher_program', array('vop_uniqueid' => $vop_uniqueid_input), 0, 0)->row_array();

        return $get_list_active_vp;
    }

    public function get_list_voucher_owned_by_user($cus_id_input)
    {
        $this->load->helper('date');
        $this->db->select('vou.*, vp.vop_image, vp.vop_title');
        $this->db->from('vou_voucher_user vou');
        $this->db->order_by('vou.vou_id', 'DESC');
        
        $this->db->where('vou.cus_id', $cus_id_input);
        $this->db->where('vou.date_expired >=', now());
        $this->db->where('vou.date_used <=', 0);
        $this->db->join('vp_voucher_program vp', 'vp.vop_uniqueid = vou.vop_uniqueid', 'left');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_list_voucher_expired_owned_by_user($cus_id_input)
    {
        $this->load->helper('date');
        $this->db->select('vou.*, vp.vop_image, vp.vop_title');
        $this->db->from('vou_voucher_user vou');
        $this->db->order_by('vou.vou_id', 'DESC');
        
        $this->db->where('vou.cus_id', $cus_id_input);
        $this->db->where('vou.date_expired <=', now());
        $this->db->where('vou.date_used', 0);
        $this->db->join('vp_voucher_program vp', 'vp.vop_uniqueid = vou.vop_uniqueid', 'left');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_list_voucher_used_owned_by_user($cus_id_input)
    {
        $this->load->helper('date');
        $this->db->select('vou.*, vp.vop_image, vp.vop_title');
        $this->db->from('vou_voucher_user vou');
        $this->db->order_by('vou.vou_id', 'DESC');
        
        $this->db->where('vou.cus_id', $cus_id_input);
        $this->db->where('vou.date_used >', 0);
        $this->db->join('vp_voucher_program vp', 'vp.vop_uniqueid = vou.vop_uniqueid', 'left');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function count_voucher_owned_by_spesific_user($vop_uniqueid_input, $cus_id_input)
    {
        $this->db->select('vou_id');
        $count_voucher_owned_by_user = $this->db->get_where('vou_voucher_user', array('cus_id' => $cus_id_input, 'vop_uniqueid' => $vop_uniqueid_input), 0, 0)->result_array();

        return count($count_voucher_owned_by_user);
    }

    public function count_all_voucher_owned_by_spesific_user($cus_id_input)
    {
        $this->load->helper('date');
        $this->db->select('vou_id');
        $count_all_voucher_owned_by_user = $this->db->get_where('vou_voucher_user', array('cus_id' => $cus_id_input,'date_used' => 0, 'date_expired >=' => now()), 0, 0)->result_array();

        return count($count_all_voucher_owned_by_user);
    }

    public function count_voucher_owned_by_all_user($vop_uniqueid_input)
    {
        $this->db->select('vou_id');
        $count_voucher_owned_by_all_user = $this->db->get_where('vou_voucher_user', array('vop_uniqueid' => $vop_uniqueid_input), 0, 0)->result_array();

        return count($count_voucher_owned_by_all_user);
    }

    public function buy_voucher($vop_uniqueid, $cus_id_input, $vop_price, $cus_pts)
    {
        if ($cus_pts >= $vop_price) {
            $this->load->helper('date');
            $this->load->model('cashier_model');
            
            
            $timenow = now();
            $reff = 'MV' . $timenow .rand(0,9);
            $vopuniqueid = $vop_uniqueid;
            $cusid = $cus_id_input;

            $this->cashier_model->create_pts($vop_price, 1, 'Redeem Voucher', $cus_id_input, 1, $reff);
            

            $data = array(
                'vou_reff' => $reff,
                'vop_uniqueid' => $vopuniqueid,
                'cus_id' => $cusid,
                'date_created' => $timenow,
                'date_expired' => $timenow + 604800,
            );

            $this->db->insert('vou_voucher_user', $data);
        }
    }
}
