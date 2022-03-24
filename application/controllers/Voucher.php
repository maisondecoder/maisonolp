<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Voucher extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('date');

        if(!$this->session->has_userdata('ses_phone') && !$this->session->has_userdata('ses_logged')) {
            redirect('auth');
        }
        
    }

    public function index()
    {
        $data['page'] = 'voucher';

        $this->load->model('voucher_model');
        $data['vp_details'] = $this->voucher_model->get_list_active_voucher_program(now());
        $data['vp_details2'] = $this->voucher_model->get_list_upcoming_voucher_program(now());
        $data['vp_details3'] = $this->voucher_model->get_list_expired_voucher_program(now());
        //print_r($data['vp_details']);
        $this->load->view('member/header');
        $this->load->view('member/page_voucher', $data);
        $this->load->view('member/footer');
    }

    public function details($vop_uniqueid = 0)
    {
        $data['page'] = 'voucher';

        $this->load->model('voucher_model');
        $this->load->model('customer_model');
        $cusid = $this->session->userdata('ses_cusid');

        $data['vp_details'] = $this->voucher_model->get_voucher_program_details($vop_uniqueid);
        if (!$data['vp_details']) {
            redirect('voucher?error=voucher-program-not-found');
        }
        $count_owned = $this->voucher_model->count_voucher_owned_by_spesific_user($vop_uniqueid, $cusid);
        $count_pts = $this->customer_model->get_point_balance($cusid);
        $count_claimed = $this->voucher_model->count_voucher_owned_by_all_user($vop_uniqueid);

        $disable = 0;
        $data['remaining_vcr'] = $data['vp_details']['vop_maxquota'] - $count_claimed;

        if ($count_claimed < $data['vp_details']['vop_maxquota']) {
            $data['issoldout'] = 0;
        } else {
            $data['issoldout'] = 1;
            $disable += 1;
        }
        if ($count_pts >= $data['vp_details']['vop_pointprice']) {
            $data['isnepts'] = 0;
        } else {
            $data['isnepts'] = 1;
            $disable += 1;
        }
        if ($count_owned < $data['vp_details']['vop_maxpuser']) {
            $data['islimit'] = 0;
        } else {
            $data['islimit'] = 1;
            $disable += 1;
        }

        if ($disable > 0) {
            $data['buttonbuy'] = 0;
        } else {
            $data['buttonbuy'] = 1;
        }

        $this->load->view('member/header');
        $this->load->view('member/page_voucher_details', $data);
        $this->load->view('member/footer');
    }

    public function buy($vop_uniqueid)
    {
        $data['page'] = 'voucher';
        
        $cusid = $this->session->userdata('ses_cusid');
        $this->load->model('voucher_model');
        $this->load->model('customer_model');

        $data['vp_details'] = $this->voucher_model->get_voucher_program_details($vop_uniqueid);
        if (!$data['vp_details']) {
            redirect('voucher?error=voucher-program-not-found');
        }
        $count_owned = $this->voucher_model->count_voucher_owned_by_spesific_user($vop_uniqueid, $cusid);
        $count_pts = $this->customer_model->get_point_balance($cusid);
        $count_claimed = $this->voucher_model->count_voucher_owned_by_all_user($vop_uniqueid);

        $disable = 0;
        $data['remaining_vcr'] = $data['vp_details']['vop_maxquota'] - $count_claimed;

        if ($data['vp_details']['date_start'] <= now() && $data['vp_details']['date_end'] >= now()) {
            if ($count_claimed < $data['vp_details']['vop_maxquota']) {
                $data['issoldout'] = 0;
            } else {
                $data['issoldout'] = 1;
                $disable += 1;
            }
            if ($count_pts >= $data['vp_details']['vop_pointprice']) {
                $data['isnepts'] = 0;
            } else {
                $data['isnepts'] = 1;
                $disable += 1;
            }
            if ($count_owned < $data['vp_details']['vop_maxpuser']) {
                $data['islimit'] = 0;
            } else {
                $data['islimit'] = 1;
                $disable += 1;
            }
        } else {
            $disable += 1;
        }

        if ($disable > 0) {
            $data['buttonbuy'] = 0;
            redirect('voucher/details/' . $vop_uniqueid . '?error=not-meet-requirement');
        } else {
            $this->load->model('customer_model');
            $count_pts = $this->customer_model->get_point_balance($cusid);
            $this->load->model('voucher_model');
            $vop_details = $this->voucher_model->get_voucher_program_details($vop_uniqueid);
            $buy = $this->voucher_model->buy_voucher($vop_details['vop_uniqueid'], $cusid, $vop_details['vop_pointprice'], $count_pts);
            redirect('user/voucher');
        }
    }
}
