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

    public function transactions($state = 'pending')
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        $this->load->model('websetting_model');
        $data['point_setting'] = $this->websetting_model->get_point_setting();

        $this->load->model('admin_model');
        if ($state == 'pending') {
            $data['pending_trx'] = $this->admin_model->get_all_pending_transactions();
            //print_r($data['pending_trx']);
            $data['state_trx'] = 'pending';
        } elseif ($state == 'approved') {
            $data['pending_trx'] = $this->admin_model->get_all_approved_transactions();
            $data['state_trx'] = 'approved';
        } else {
            redirect('admin/transactions/pending');
        }

        $this->load->view('admin/header');
        $this->load->view('admin/page_transactions', $data);
        $this->load->view('admin/footer');
    }

    public function members($status = 'active')
    {
        if (!$this->session->has_userdata('ses_admin_id') && !$this->session->has_userdata('ses_admin_email') && !$this->session->has_userdata('ses_admin_token')) {
            $this->session->set_flashdata('admin_login', "<p class='alert alert-danger'>Invalid Access!</p>");
            redirect('admin/auth');
            die('Cannot Access Admin Page');
        }

        $this->load->model('admin_model');
        if ($status == 'active') {

            $data['member_list'] = $this->admin_model->get_all_members(1);
            $data['state_tab'] = 'active';
        } elseif ($status == 'inactive') {
            $data['member_list'] = $this->admin_model->get_all_members(0);
            $data['state_tab'] = 'inactive';
        } else {
            redirect('admin/members/active');
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

            $pass_hash = password_hash($conpass,PASSWORD_DEFAULT);
            $this->load->model('admin_model');
            $change_password = $this->admin_model->change_password($this->session->userdata('ses_admin_email'),$pass_hash);

            if($change_password){
                $this->session->set_flashdata('admin_change_password', "<p class='alert alert-success'>Password changed successfully.</p>");
                redirect('admin/change_password?msg=change-password-success');
            }else{
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

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=list_transaction_data.xls");
        $this->load->model('admin_model');
        $data['pending_trx'] = $this->admin_model->get_all_transactions();
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

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=list_member_data.xls");
        $this->load->model('admin_model');
        $data['member_list'] = $this->admin_model->get_all_members(1);
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

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=list_cashier_data.xls");
        $this->load->model('admin_model');
        $data['cashier_list'] = $this->admin_model->get_all_cashiers(1);
        $data['state_trx'] = 'pending';
        $this->load->view('admin/export_cashier', $data);
    }

    public function vod(){
        echo '
        ';
    }
}
