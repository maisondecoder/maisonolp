<?php

class Websetting_model extends CI_Model
{

    //memanggil semua list voucher program
    public function get_point_setting()
    {
        $this->db->select('*');
        $point_setting = $this->db->get_where('ps_point_settings', array('ps_id' => 0), 1, 0)->row_array();

        return $point_setting;
    }
}