<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('date');
    }

    public function auth()
    {
        if ($this->session->has_userdata('ses_admin_id') && $this->session->has_userdata('ses_admin_email') && $this->session->has_userdata('ses_admin_token')) {
            redirect('admin');
            die('Cannot Access Login Page');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email-input', 'Email', 'required');
        $this->form_validation->set_rules('pass-input', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/auth');
        } else {
            $email = $this->input->post('email-input');
            $pass = $this->input->post('pass-input');

            $this->load->model('admin_model');
            $login = $this->admin_model->login_verify($email, $pass);
            if ($login) {
                //Login Success
                $this->session->set_userdata('ses_admin_id', $login['admin_id']);
                $this->session->set_userdata('ses_admin_email', $login['admin_email']);
                $token = md5($login['admin_id'] . $login['admin_email']);
                $this->session->set_userdata('ses_admin_token', $token);

                redirect('admin');
            } else {
                //Login Failed
                $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Email or Password is not match!</p>");
                $this->load->view('admin/auth');
            }
        }
    }

    public function index()
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }
        //echo $_SESSION['ses_admin_id'];

        $this->load->view('admin/header');
        $this->load->view('admin/index');
        $this->load->view('admin/footer');
    }

    public function transactions($branch_id = 1, $state = 'pending')
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        $this->load->model('websetting_model');
        $this->load->model('admin_model');
        $data['point_setting'] = $this->websetting_model->get_point_setting();

        $stores = $this->admin_model->get_stores();
        //print_r($stores);
        $cabang_id = array();
        $cabang_label = array();
        $jenis = array("pending", "approved");
        foreach($stores as $key=>$store){
            array_push($cabang_id,$store['store_id']);
            array_push($cabang_label,$store['store_branch']);
        }
        
        $data['cabang_id'] = $cabang_id;
        $data['cabang_label'] = $cabang_label;
        if (in_array($state, $jenis) && in_array($branch_id, $cabang_id)) {
            
                $data['branch_id'] = $branch_id;

            if ($state == 'pending') {
                $data['pending_trx'] = $this->admin_model->get_all_pending_transactions($branch_id);
                $data['state_trx'] = 'pending';
            } elseif ($state == 'approved') {
                $data['pending_trx'] = $this->admin_model->get_all_approved_transactions($branch_id);
                $data['state_trx'] = 'approved';
            }
        }else {
            redirect('admin/transactions/');
        }
        
        $this->load->view('admin/header');
        $this->load->view('admin/page_transactions', $data);
        $this->load->view('admin/footer');
    }

    public function members($status = 'all')
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        $this->load->model('admin_model');
        $this->load->model('customer_model');
        if ($status == 'all') {
            $data['member_list'] = $this->admin_model->get_all_members('all','all');
            $data['state_tab'] = 'all';
        }elseif ($status == 'active') {
            $data['member_list'] = $this->admin_model->get_all_members(1,'all');
            $data['state_tab'] = 'active';
        }elseif ($status == 'inactive') {
            $data['member_list'] = $this->admin_model->get_all_members(0,'all');
            $data['state_tab'] = 'inactive';
        }elseif ($status == 'suspend') {
            $data['member_list'] = $this->admin_model->get_all_members(2,'all');
            $data['state_tab'] = 'suspend';
        }else {
            redirect('admin/members/all');
        }

        $this->load->view('admin/header');
        $this->load->view('admin/page_members', $data);
        $this->load->view('admin/footer');
    }

    public function cashiers($status = 'active')
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        $this->load->model('admin_model');
        if ($status == 'active') {

            $data['member_list'] = $this->admin_model->get_all_cashiers(1);
            $data['state_tab'] = 'active';
        } elseif ($status == 'inactive') {
            $data['member_list'] = $this->admin_model->get_all_cashiers(0);
            $data['state_tab'] = 'inactive';
        } else {
            redirect('admin/members/active');
        }

        $this->load->view('admin/header');
        $this->load->view('admin/page_cashier', $data);
        $this->load->view('admin/footer');
    }

    public function export()
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        $this->load->view('admin/header');
        $this->load->view('admin/page_export');
        $this->load->view('admin/footer');
    }

    public function settings_point()
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        $this->load->model('admin_model');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('point-pair', 'Point Value', 'required');
        $this->form_validation->set_rules('point-multi', 'Point Multiplier', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['point'] = $this->admin_model->get_point_settings();

            $this->load->view('admin/header');
            $this->load->view('admin/page_settings_point', $data);
            $this->load->view('admin/footer');
        } else {
            $value = $this->input->post('point-pair');
            $multi = $this->input->post('point-multi');

            if ($this->admin_model->set_point_settings($value, $multi)) {
                $this->session->set_flashdata('settings_point_change', "<p class='alert alert-success'>Point Setting Changes Saved.</p>");
                redirect('admin/settings_point?msg=point-settings-changed-successfully');
            } else {
                $this->session->set_flashdata('settings_point_change', "<p class='alert alert-danger'>Point Setting Changes Failed.</p>");
                redirect('admin/settings_point?msg=point-settings-failed');
            }
        }
    }

    public function frag_edit_member($cusid = -1, $custat = -1, $reason='')
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }
        $this->load->model('customer_model');
        $this->load->model('admin_model');
        $check = $this->customer_model->get_cus_profile($cusid);

        if ($check) {
            $edit_stat = $this->admin_model->edit_stat_member($cusid, $custat, $reason);
            print_r($edit_stat);
        } else {
            echo 'Data Invalid';
            return false;
        }
    }

    public function frag_approve($trx_id_input = 0, $trx_reff_input = 0)
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        $this->load->model('admin_model');
        $check = $this->admin_model->check_pending_trx($trx_id_input);

        if ($check) {
            $approve = $this->admin_model->approve($trx_id_input, $trx_reff_input);
            print_r($approve);
        } else {
            echo 'Transaction Invalid';
            return false;
        }
    }

    public function frag_trx_data()
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        $trx_reff = $this->input->post('reff_input');
        $trx_nominal = $this->input->post('nominal_input');

        $this->load->model('admin_model');
        $this->load->model('websetting_model');
        $point_setting = $this->websetting_model->get_point_setting();
        $trx_target = $this->admin_model->get_one_transaction($trx_reff);


        $trx_data = $this->admin_model->edit_trx_nominal($trx_reff, $trx_nominal, $point_setting['ps_point_per'], $trx_target['pts_multiplier']);

        if ($trx_data) {
            print_r($trx_data);
        } else {
            echo 'Transaction Invalid';
            return false;
        }
    }
    public function change_password()
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('pass-input', 'New Password', 'required');
        $this->form_validation->set_rules('conpass-input', 'New Password Confirmation', 'required|matches[pass-input]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/header');
            $this->load->view('admin/page_change_password');
            $this->load->view('admin/footer');
        } else {
            $pass = $this->input->post('pass-input');
            $conpass = $this->input->post('conpass-input');

            $pass_hash = password_hash($conpass, PASSWORD_DEFAULT);
            $this->load->model('admin_model');
            $change_password = $this->admin_model->change_password($this->session->userdata('ses_admin_email'), $pass_hash);

            if ($change_password) {
                $this->session->set_flashdata('admin_change_password', "<p class='alert alert-success'>Password changed successfully.</p>");
                redirect('admin/change_password?msg=change-password-success');
            } else {
                $this->session->set_flashdata('admin_change_password', "<p class='alert alert-danger'>Failed to change password!</p>");
                redirect('admin/change_password?msg=change-password-failed');
            }
        }
    }
    public function sign_out()
    {
        $this->session->set_flashdata('admin_login', "<p class='alert alert-warning'>Sign Out Success!</p>");
        unset($_SESSION['ses_admin_id']);
        unset($_SESSION['ses_admin_email']);
        unset($_SESSION['ses_admin_token']);
        redirect('admin/auth');
    }

    public function export_trx()
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        $min = strtotime($this->input->post('trxmin'));
        $max = strtotime($this->input->post('trxmax'));
        
        //header("Content-type: application/vnd-ms-excel");
        //header("Content-Disposition: attachment; filename=list_transaction_data.xls");
        $this->load->model('admin_model');
        $data['pending_trx'] = $this->admin_model->get_all_transactions_filter($min, $max);
        $data['state_trx'] = 'pending';
        $this->load->view('admin/export_trx', $data);
    }

    public function export_member()
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        $celebrate = $this->input->post('memceleb');
        $data['spendstart'] = $this->input->post('spendstart');
        //header("Content-type: application/vnd-ms-excel");
        //header("Content-Disposition: attachment; filename=list_member_data.xls");
        $this->load->model('admin_model');
        $this->load->model('customer_model');
        $data['member_list'] = $this->admin_model->get_all_members(1,$celebrate);
        $data['state_trx'] = 'pending';
        $this->load->view('admin/export_member', $data);
    }

    public function export_cashier()
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        //header("Content-type: application/vnd-ms-excel");
        //header("Content-Disposition: attachment; filename=list_cashier_data.xls");
        $this->load->model('admin_model');
        $data['cashier_list'] = $this->admin_model->get_all_cashiers(1);
        $data['state_trx'] = 'pending';
        $this->load->view('admin/export_cashier', $data);
    }

    public function voucher_program()
    {
        $this->load->model('admin_model');
        $data['voucher_program'] = $this->admin_model->all_voucher_program();
        $this->load->view('admin/header');
        $this->load->view('admin/page_voucher_program', $data);
        $this->load->view('admin/footer');
    }

    public function delete_voucher_program($vop_uniqueid = '0')
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        if ($vop_uniqueid == '0') {
            redirect('admin/voucher_program');
        } else {
            $this->load->model('admin_model');
            $vop_data = $this->admin_model->specific_voucher_program($vop_uniqueid);
            if ($vop_data) {
                $data['vp_data'] = $vop_data;
                //print_r($data['vp_data']);
                $delete = $this->admin_model->delete_voucher_program($vop_uniqueid);
                if ($delete) {
                    redirect('admin/voucher_program?msg=delete-success');
                } else {
                    redirect('admin/voucher_program?msg=delete-failed');
                }
            } else {
                redirect('admin/voucher_program');
            }
        }

        $this->admin_model->delete_voucher_program($vop_uniqueid);
    }

    public function add_voucher_program()
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }
        $this->load->library('form_validation');

        $this->form_validation->set_rules('vp-title', 'Program Title', 'required');
        $this->form_validation->set_rules('vp-datestart', 'Date Start', 'required');
        $this->form_validation->set_rules('vp-dateend', 'Date End', 'required');
        $this->form_validation->set_rules('vp-timestart', 'Time Start', 'required');
        $this->form_validation->set_rules('vp-timeend', 'Time End', 'required');
        $this->form_validation->set_rules('vp-desc', 'Description', 'required');
        $this->form_validation->set_rules('vp-quota', 'Total Quota', 'required');
        $this->form_validation->set_rules('vp-limit', 'Limit', 'required');
        $this->form_validation->set_rules('vp-price', 'Price', 'required');
        $this->form_validation->set_rules('vp-image', 'Inmage', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/header');
            $this->load->view('admin/page_voucher_program_add');
            $this->load->view('admin/footer');
        } else {
            $this->load->helper('date');

            $title = $this->input->post('vp-title');
            $datestart = $this->input->post('vp-datestart');
            $dateend = $this->input->post('vp-dateend');
            $timestart = $this->input->post('vp-timestart');
            $timeend = $this->input->post('vp-timeend');
            $desc = $this->input->post('vp-desc');
            $quota = $this->input->post('vp-quota');
            $limit = $this->input->post('vp-limit');
            $price = $this->input->post('vp-price');

            $start = strtotime($datestart . ' ' . $timestart);
            $end = strtotime($dateend . ' ' . $timeend);

            $unique = 'MLV' . now();
            $image = $this->input->post('vp-image');

            $this->load->model('admin_model');
            $add = $this->admin_model->add_voucher_program($title, $desc, $quota, $limit, $price, $start, $end, $unique, $image);
            if ($add) {
                redirect('admin/voucher_program?msg=success');
            } else {
                redirect('admin/voucher_program?msg=failed');
            }
        }
    }

    public function edit_voucher_program($vop_uniqueid = '0')
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        if ($vop_uniqueid == '0') {
            redirect('admin/voucher_program');
        } else {
            $this->load->model('admin_model');
            $vop_data = $this->admin_model->specific_voucher_program($vop_uniqueid);
            if ($vop_data) {
                $data['vp_data'] = $vop_data;
                //print_r($data['vp_data']);
            } else {
                redirect('admin/voucher_program');
            }
        }
        $this->load->library('form_validation');

        $this->form_validation->set_rules('vp-title', 'Program Title', 'required');
        $this->form_validation->set_rules('vp-datestart', 'Date Start', 'required');
        $this->form_validation->set_rules('vp-dateend', 'Date End', 'required');
        $this->form_validation->set_rules('vp-timestart', 'Time Start', 'required');
        $this->form_validation->set_rules('vp-timeend', 'Time End', 'required');
        $this->form_validation->set_rules('vp-desc', 'Description', 'required');
        $this->form_validation->set_rules('vp-quota', 'Total Quota', 'required');
        $this->form_validation->set_rules('vp-limit', 'Limit', 'required');
        $this->form_validation->set_rules('vp-price', 'Price', 'required');
        $this->form_validation->set_rules('vp-image', 'Inmage', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/header');
            $this->load->view('admin/page_voucher_program_edit', $data);
            $this->load->view('admin/footer');
        } else {
            $this->load->helper('date');

            $title = $this->input->post('vp-title');
            $datestart = $this->input->post('vp-datestart');
            $dateend = $this->input->post('vp-dateend');
            $timestart = $this->input->post('vp-timestart');
            $timeend = $this->input->post('vp-timeend');
            $desc = $this->input->post('vp-desc');
            $quota = $this->input->post('vp-quota');
            $limit = $this->input->post('vp-limit');
            $price = $this->input->post('vp-price');

            $start = strtotime($datestart . ' ' . $timestart);
            $end = strtotime($dateend . ' ' . $timeend);

            $image = $this->input->post('vp-image');

            $this->load->model('admin_model');
            $edit = $this->admin_model->edit_voucher_program($title, $desc, $quota, $limit, $price, $start, $end, $vop_uniqueid, $image);
            if ($edit) {
                redirect('admin/voucher_program?msg=edit-success');
            } else {
                redirect('admin/voucher_program?msg=edit-failed');
            }
        }
    }
}
