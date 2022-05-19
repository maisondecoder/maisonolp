<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('customer_model');
        $cus_status = $this->customer_model->cus_status($_SESSION['ses_phone']);
        //print_r($this->session->userdata());

        if (!$cus_status['is_profiled']) {
            redirect('auth/create_profile');
        }
        if (!$cus_status['is_verified']) {
            redirect('auth/otp_verification');
        }
        if (!$cus_status['cus_status']) {
            redirect('auth/account_suspended');
        }
    }

    public function test_vod()
    {
        $data['page'] = 'home';
        $this->load->view('member/header');
        $this->load->view('member/page_feeds', $data);
        $this->load->view('member/footer');
    }

    public function index()
    {

        if (!$this->session->has_userdata('ses_cusid')) {
            redirect('auth');
        }
        $data['page'] = 'profile';
        $phone = $this->session->userdata('ses_phone');
        $cusid = $this->session->userdata('ses_cusid');

        $this->load->model('customer_model');
        $this->load->model('voucher_model');

        $data['profile'] = $this->customer_model->find_cus($phone);

        $data['total_spending'] = $this->customer_model->get_total_spending($cusid);
        $data['profile_data'] = $this->customer_model->get_cus_profile($cusid);

        $level = $this->customer_model->get_level($data['total_spending']);
        $data['level'] = $level['ml_name'];

        $data['level_bg'] = $level['ml_color'];
        $data['level_text'] = $level['ml_text'];


        $data['total_trx'] = $this->customer_model->get_count_cus_trx($cusid);
        $data['total_pts'] = $this->customer_model->get_point_balance($cusid);
        $data['total_vcr'] = $this->voucher_model->count_all_voucher_owned_by_spesific_user($cusid);

        $this->load->view('member/header');
        $this->load->view('member/page_profile_2', $data);
        $this->load->view('member/footer');
    }

    public function level()
    {
        $data['page'] = 'profile';
        $phone = $this->session->userdata('ses_phone');
        $cusid = $this->session->userdata('ses_cusid');

        $this->load->model('customer_model');
        $this->load->model('voucher_model');

        $data['list_trx'] = $this->customer_model->get_list_cus_trx($cusid);
        $data['profile'] = $this->customer_model->find_cus($phone);

        $data['total_spending'] = $this->customer_model->get_total_spending($cusid);
        $data['profile_data'] = $this->customer_model->get_cus_profile($cusid);


        $level = $this->customer_model->get_level($data['total_spending']);
        $data['level'] = $level['ml_name'];
        $data['next_spend'] = $level['ml_range_max'] + 1 - $data['total_spending'];
        $data['percentage'] = ($data['total_spending'] - $level['ml_range_min']) / ($level['ml_range_max'] - $level['ml_range_min']) * 100;

        $data['total_trx'] = $this->customer_model->get_count_cus_trx($cusid);
        $data['total_pending'] = $this->customer_model->get_count_cus_trx_pending($cusid);
        $data['total_pts'] = $this->customer_model->get_point_balance($cusid);
        $data['total_vcr'] = $this->voucher_model->count_all_voucher_owned_by_spesific_user($cusid);

        $this->load->view('member/header');
        $this->load->view('member/page_profile_level', $data);
        $this->load->view('member/footer');
    }

    public function point($state = "total")
    {
        $data['page'] = 'profile';
        $cusid = $this->session->userdata('ses_cusid');

        $this->load->model('customer_model');
        //$data['list_pts'] = $this->customer_model->get_list_cus_pts($cusid);

        $data['total_trx'] = $this->customer_model->get_count_cus_pts_audited($cusid);
        $data['total_pending'] = $this->customer_model->get_count_cus_pts_pending($cusid);
        $data['total_pts'] = $this->customer_model->get_point_balance($cusid);
        
        $jenis = array("total", "success", "pending");

        if (in_array($state, $jenis)) {
            if ($state == "total") {
                $data['list_pts'] = $this->customer_model->get_list_cus_pts($cusid);
                $data['state'] = "total";
                $data['text_no_data'] = "You don't have any point history.";
            } elseif ($state == "success") {
                $data['list_pts'] = $this->customer_model->get_list_cus_pts_by_status($cusid, 1);
                $data['state'] = "success";
                $data['text_no_data'] = "You don't have any succeed point history.";
            } elseif ($state == "pending") {
                $data['list_pts'] = $this->customer_model->get_list_cus_pts_by_status($cusid, 0);
                $data['state'] = "pending";
                $data['text_no_data'] = "You don't have any pending point history.";
            }
        } else {
            redirect('user/point');
        }

        $this->load->view('member/header');
        $this->load->view('member/page_profile_my_points', $data);
        $this->load->view('member/footer');
    }

    public function transaction($state = "total")
    {
        $data['page'] = 'profile';
        $cusid = $this->session->userdata('ses_cusid');

        $this->load->model('customer_model');
        //$data['list_trx'] = $this->customer_model->get_list_cus_trx($cusid);
        $data['total_spending'] = $this->customer_model->get_total_spending($cusid);
        $data['total_trx'] = $this->customer_model->get_count_cus_trx($cusid);
        $data['total_pending'] = $this->customer_model->get_count_cus_trx_pending($cusid);

        $jenis = array("total", "success", "pending");

        if (in_array($state, $jenis)) {
            if ($state == "total") {
                $data['list_trx'] = $this->customer_model->get_list_cus_trx($cusid);
                $data['state'] = "total";
                $data['text_no_data'] = "You don't have any transaction history.";
            } elseif ($state == "success") {
                $data['list_trx'] = $this->customer_model->get_list_cus_trx_by_status($cusid, 1);
                $data['state'] = "success";
                $data['text_no_data'] = "You don't have any succeed transaction history.";
            } elseif ($state == "pending") {
                $data['list_trx'] = $this->customer_model->get_list_cus_trx_by_status($cusid, 0);
                $data['state'] = "pending";
                $data['text_no_data'] = "You don't have any pending transaction history.";
            }
        } else {
            redirect('user/transaction');
        }

        $this->load->view('member/header');
        $this->load->view('member/page_profile_my_transactions', $data);
        $this->load->view('member/footer');
    }

    public function voucher($state = "active")
    {
        $data['page'] = 'profile';
        $cusid = $this->session->userdata('ses_cusid');
        $this->load->model('voucher_model');
        $jenis = array("active", "expired", "used");

        if (in_array($state, $jenis)) {
            if ($state == "active") {
                $data['list_vou'] = $this->voucher_model->get_list_voucher_owned_by_user($cusid);
                $data['state'] = "active";
                $data['filter_image'] = 0;
            } elseif ($state == "expired") {
                $data['list_vou'] = $this->voucher_model->get_list_voucher_expired_owned_by_user($cusid);
                $data['state'] = "expired";
                $data['filter_image'] = 80;
            } elseif ($state == "used") {
                $data['list_vou'] = $this->voucher_model->get_list_voucher_used_owned_by_user($cusid);
                $data['state'] = "used";
                $data['filter_image'] = 80;
            }
        } else {
            redirect('user/voucher/active');
        }

        $this->load->view('member/header');
        $this->load->view('member/page_profile_my_vouchers', $data);
        $this->load->view('member/footer');
    }

    public function change_password()
    {
        $data['page'] = 'profile';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('pass-input', 'Password', 'required');
        $this->form_validation->set_rules('conpass-input', 'Confirmation Password', 'required|matches[pass-input]', array(
            'matches'     => 'Confirmation Password is not matched.'
        ));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('member/header');
            $this->load->view('member/page_setting_change_pass', $data);
            $this->load->view('member/footer');
        } else {
            $cusid = $this->session->userdata('ses_cusid');
            $pass = $this->input->post('pass-input');
            $this->load->model('customer_model');
            $change_pass = $this->customer_model->change_password($pass, $cusid);
            if ($change_pass) {
                redirect('user?msg=change-password-success');
            }
        }
    }

    public function edit_profile()
    {
        $data['page'] = 'profile';
        $cusid = $this->session->userdata('ses_cusid');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('first-input', 'First Name', 'required');
        $this->form_validation->set_rules('last-input', 'Last Name', 'required');
        $this->form_validation->set_rules('gender-input', 'Gender', 'required');
        $this->form_validation->set_rules('birth-input', 'Date of Birth', 'required');
        $this->form_validation->set_rules('celebrate-input', 'Day Celebrate', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->model('customer_model');
            $data['profile'] = $this->customer_model->get_cus_profile($cusid);

            $this->load->view('member/header');
            $this->load->view('member/page_setting_edit_profile', $data);
            $this->load->view('member/footer');
        } else {
            $first = $this->input->post('first-input');
            $last = $this->input->post('last-input');
            $gender = $this->input->post('gender-input');
            $dob = $this->input->post('birth-input');
            $celebrate = $this->input->post('celebrate-input');

            $this->load->model('customer_model');
            $edit_profile = $this->customer_model->edit_profile($cusid, $first, $last, $gender, $dob, $celebrate);
            if ($edit_profile) {
                redirect('user?msg=edit-profile-success');
            } else {
                redirect('user');
            }
        }
    }

    public function get_qrid($string)
    {
        $string_new = str_replace("%20", " ", $string);
        include 'vendor/phpqrcode/phpqrcode.php';

        QRcode::png($string_new);
    }
}
