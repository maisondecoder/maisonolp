<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cashier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper('date');
    }

    public function auth()
    {
        if ($this->session->has_userdata('ses_store_id') && $this->session->has_userdata('ses_cas_id') && $this->session->has_userdata('ses_cas_email') && $this->session->has_userdata('ses_cas_token')) {
            redirect('cashier');
            die('Cannot Access Login Page');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email-input', 'Email', 'required');
        $this->form_validation->set_rules('pass-input', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('cashier/auth');
        } else {
            $email = $this->input->post('email-input');
            $pass = $this->input->post('pass-input');

            $this->load->model('cashier_model');
            $login = $this->cashier_model->login_verify($email, $pass);
            if ($login) {
                //Login Success
                $this->session->set_userdata('ses_cas_id', $login['cas_id']);
                $this->session->set_userdata('ses_cas_email', $login['cas_email']);
                $this->session->set_userdata('ses_store_id', $login['store_id']);
                $token = md5($login['cas_id'] . $login['cas_email']);
                $this->session->set_userdata('ses_cas_token', $token);

                redirect('cashier');
            } else {
                //Login Failed
                $this->session->set_flashdata('cashier_login', "<p class='alert alert-danger'>Email or Password is not match!</p>");
                $this->load->view('cashier/auth');
            }
        }
    }

    

    public function index()
    {
        
        if (!$this->session->has_userdata('ses_store_id') || !$this->session->has_userdata('ses_cas_id') || !$this->session->has_userdata('ses_cas_email') || !$this->session->has_userdata('ses_cas_token')) {
            redirect('cashier/auth');
            die('Cannot Access Cashier Page');
        }

        $data['page'] = 'point';
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nominal-input', 'Nominal', 'required|numeric');
        $this->load->model('websetting_model');
        $point_setting = $this->websetting_model->get_point_setting();
        $data['point_setting'] = $point_setting;

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('cashier/header');
            $this->load->view('cashier/page_point_scanner', $data);
            $this->load->view('cashier/footer');
        } else {
            $qrid = $this->input->post('qrid-input');
            echo $qrid;
            $nominal = $this->input->post('nominal-input');
            $jurnal = $this->input->post('jurnal-input');

            $this->load->model('customer_model');
            $this->load->model('cashier_model');


            $cus_data = $this->customer_model->find_cus_by_hash($qrid);
            if ($cus_data) {
                $generated_trx_reff = 'ML' . now() . '1';
                $this->cashier_model->create_trx($generated_trx_reff, $nominal, "Transaksi Store", 0, $this->session->userdata('ses_store_id'), $cus_data['cus_id'], $jurnal, $this->session->userdata('ses_cas_id'),$point_setting['ps_point_multiplier']);

                $bonus_point = $nominal / $point_setting['ps_point_per'] * $point_setting['ps_point_multiplier'];
                $this->cashier_model->create_pts($bonus_point, 0, 'Transaksi Store', $cus_data['cus_id'], 0, $generated_trx_reff);

                redirect('cashier/result/'.$bonus_point);
            } else {
                redirect('cashier?error=member-not-found');
            }
        }
    }

    public function profile()
    {
        if (!$this->session->has_userdata('ses_store_id') || !$this->session->has_userdata('ses_cas_id') || !$this->session->has_userdata('ses_cas_email') || !$this->session->has_userdata('ses_cas_token')) {
            redirect('cashier/auth');
            die('Cannot Access Cashier Page');
        }

        $data['page'] = 'profile';
        $this->load->model('cashier_model');
        $data['cashier_data'] = $this->cashier_model->get_cashier_profile($this->session->userdata('ses_cas_email'));

        $this->load->view('cashier/header');
        $this->load->view('cashier/page_profile', $data);
        $this->load->view('cashier/footer');
    }

    public function change_password()
    {
        if (!$this->session->has_userdata('ses_store_id') || !$this->session->has_userdata('ses_cas_id') || !$this->session->has_userdata('ses_cas_email') || !$this->session->has_userdata('ses_cas_token')) {
            redirect('cashier/auth');
            die('Cannot Access Cashier Page');
        }

        $data['page'] = 'profile';
        $this->load->library('form_validation');

        $this->form_validation->set_rules('pass-input', 'New Password', 'required');
        $this->form_validation->set_rules('conpass-input', 'New Password Confirmation', 'required|matches[pass-input]',array(
            'matches'     => 'Confirmation Password is not matched.'
        ));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('cashier/header');
            $this->load->view('cashier/page_change_password', $data);
            $this->load->view('cashier/footer');
        } else {
            $pass = $this->input->post('pass-input');
            $conpass = $this->input->post('conpass-input');

            $pass_hash = password_hash($conpass,PASSWORD_DEFAULT);
            $this->load->model('cashier_model');
            $change_password = $this->cashier_model->change_password($this->session->userdata('ses_cas_email'),$pass_hash);

            if($change_password){
                $this->session->set_flashdata('cashier_change_password', "<p class='alert alert-success'>Password changed successfully.</p>");
                redirect('cashier/profile?msg=change-password-success');
            }else{
                $this->session->set_flashdata('cashier_change_password', "<p class='alert alert-danger'>Failed to change password!</p>");
                redirect('cashier/profile?msg=change-password-failed');
            }
            
        }

        
    }

    //AJAX Purpose
    public function summary_member()
    {
        if (!$this->session->has_userdata('ses_cas_id') && !$this->session->has_userdata('ses_cas_email') && !$this->session->has_userdata('ses_cas_token')) {
            redirect('cashier/auth');
        }

        $cus_hash = $this->input->post('hash_input');
        if (!$cus_hash) {
            redirect('cashier');
        }

        $this->load->model('cashier_model');
        $cus_data = $this->cashier_model->scan_qrid($cus_hash);

        if ($cus_data) {
            $data = array("status" => 1, "name" => $cus_data['profile_first_name'].' '.$cus_data['profile_last_name']);
            echo json_encode($data);
        } else {
            $data = array("status" => 0, "name" => "Member not found!");
            echo json_encode($data);
        }
    }

    public function result($pts = 0)
    {
        if (!$this->session->has_userdata('ses_store_id') || !$this->session->has_userdata('ses_cas_id') || !$this->session->has_userdata('ses_cas_email') || !$this->session->has_userdata('ses_cas_token')) {
            redirect('cashier/auth');
            die('Cannot Access Cashier Page');
        }
        $data['page'] = 'point';
        $data['pts_data'] = $pts;
        

        $this->load->view('cashier/header');
        $this->load->view('cashier/page_point_success', $data);
        $this->load->view('cashier/footer');
    }

    public function sign_out()
    {
        unset($_SESSION['ses_cas_id']);
        unset($_SESSION['ses_cas_email']);
        unset($_SESSION['ses_cas_token']);
        redirect('cashier/auth');
    }



    public function forgot_password(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email-input', 'Email Address', 'required');
        $email = $this->input->post('email-input');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('cashier/cashier_forgot_pass_1');
        } else {
            
            $this->load->model('cashier_model');
            $check_cashier = $this->cashier_model->get_cashier_profile($email);

            if ($check_cashier) {
                
                $token = $this->cashier_model->cashier_create_token_reset($check_cashier['cas_id']);

                $sender = "auto-service";
                $symbol_send = "@";
                $domain_send = "maisonliving.id";
                $sendergroup = $sender . $symbol_send . $domain_send;
                $secret = '~~Maisonliving123~~';

                $config = [
                    'protocol' => 'smtp',
                    'priority' => 2,
                    'smtp_host' => 'ssl://srv115.niagahoster.com',
                    'smtp_user' => $sendergroup,
                    'smtp_pass' => $secret,
                    'smtp_port' => 465,
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n"
                ];

                $this->load->library('email', $config);
                $this->email->initialize($config);

                $this->email->from($sendergroup, 'Auto-Services Maison Living');
                $this->email->to($email);
                $this->email->subject('Password Reset Request ['.$token.']');
                $this->email->message('You have submitted a password reset request, click the following link to create a new password: <a href="'.base_url().'cashier/reset_password/' . $token . '" target="_blank">Create a New Password.</a>');

                $this->email->send();
                
                header( "refresh:7;url=".base_url('cashier/auth'));
                $this->load->view('cashier/cashier_forgot_pass_2');
            } else {
                $this->session->set_flashdata("forgot_password_msg", "<p class='alert alert-danger'>The information you provided does not match, please try again.</p>");
                redirect('cashier/forgot_password');
            }
        }
        
    }

    public function reset_password($token='0'){
        if ($token == '0') {
            redirect('cashier/forgot_password');
            echo 'reset token is invalid or expired!';
            die;
        } else {
            $this->load->model('cashier_model');
            $check_token = $this->cashier_model->cashier_check_token_reset($token);
            if ($check_token) {
                $data['token'] = $token;
            } else {
                echo 'reset token is invalid or expired!';
                die;
            }
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('pass-input', 'Password', 'required');
        $this->form_validation->set_rules('conpass-input', 'Password Confirmation', 'required|matches[pass-input]');

        $pass = $this->input->post('conpass-input');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('cashier/cashier_reset_pass', $data);
        } else {
            $this->cashier_model->cashier_change_password($pass, $check_token['cas_id']);
            $this->session->set_flashdata("cashier_login", "<p class='alert alert-info'>Change password has been successful. Please login using the new password you created.</p>");
            redirect('cashier/auth');
        }
    }
}
