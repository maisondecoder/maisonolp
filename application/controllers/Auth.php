<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        //print_r($this->session->userdata());
    }

    public function index()
    {
        if ($this->session->userdata('ses_phone')) {
            redirect('auth/otp_verification');
            die;
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nomor-wa', 'Whatsapp Number', 'required|numeric|min_length[10]|max_length[14]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/page_auth_home');
        } else {
            $no_tujuan = '62' . $this->input->post('nomor-wa');
            $this->session->set_userdata('ses_phone', $no_tujuan);
            $this->load->model('auth_model');

            if ($this->auth_model->check_existing_member($no_tujuan)) {
                $this->session->set_flashdata('login_password', "<p class='alert alert-info'>Your Whatsapp Number (+" . $this->session->userdata('ses_phone') . ") is an existing account, enter your password to access your account.</p>");
                redirect('auth/signin');
            } else {
                if (!$this->auth_model->check_latest_otp($no_tujuan)) {
                    $this->load->model('sendtalk_model');
                    $this->sendtalk_model->send_otp($no_tujuan);
                    $this->session->set_flashdata('verify_otp_msg', "<p class='alert alert-warning'>We've sent an OTP to your Whatsapp (+" . $this->session->userdata('ses_phone') . "), please check your Whatsapp and enter the OTP number below.</p>");
                    redirect('auth/otp_verification?msg=new-otp-sent');
                } else {
                    $this->session->set_flashdata('verify_otp_msg', "<p class='alert alert-warning'>There is an active OTP sent to (+" . $this->session->userdata('ses_phone') . ") earlier, it is valid for 5 minutes before being able to resend, please check your Whatsapp.</p>");
                    redirect('auth/otp_verification?msg=already-have-otp');
                }
            }
        }
    }

    public function signin()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('pass-input', 'Password', 'required');
        if($this->session->has_userdata('ses_phone')){
            $phone = $this->session->userdata('ses_phone');
            $data['ses_phone'] = $phone;
        }else{
            $data['ses_phone'] = null;
            $phone = $this->input->post('phone-input');
        }
        $pass = $this->input->post('pass-input');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/page_login_existing', $data);
        } else {
            $this->load->model('customer_model');
            $login = $this->customer_model->login_verify($phone, $pass);
            //print_r($login);
            //die;
            if ($login) {
                $this->session->set_userdata('ses_cusid', $login['cus_id']);
                $this->session->set_userdata('ses_logged', true);
                $this->session->set_userdata('ses_phone', $phone);
                $this->session->set_userdata('ses_verified', $login['is_verified']);
                $this->session->set_userdata('ses_profiled', $login['is_profiled']);
                redirect('user');
            } else {
                //Login Failed
                $this->session->set_flashdata('login_password', "<p class='alert alert-danger'>Login failed! Password not match!</p>");
                redirect('auth/signin');
            }
        }
    }

    public function otp_verification()
    {
        if (!$this->session->userdata('ses_phone')) {
            redirect('auth');
            die;
        }
        if ($this->session->userdata('ses_otp_ok')) {
            redirect('auth/create_password');
            die;
        }

        $this->load->model('customer_model');
        $cus_status = $this->customer_model->cus_status($_SESSION['ses_phone']);

        if ($cus_status['is_verified']) {
            redirect('auth/create_profile');
            die;
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('kode-otp', 'OTP Number', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/page_otp_verify');
        } else {
            $wa_input = $this->session->userdata('ses_phone');
            $otp_input = $this->input->post('kode-otp');
            $this->load->model('auth_model');
            $otp_db = $this->auth_model->verify_otp($wa_input, $otp_input);
            if ($otp_db) {
                $this->session->set_userdata('ses_otp_ok', true);
                $this->load->model('customer_model');
                redirect('auth/create_password');
            } else {
                $this->session->set_flashdata('verify_otp_msg', "<p class='alert alert-danger'>OTP number is not valid or expired.</p>");
                redirect('auth/otp_verification?msg=otp-not-valid');
            }
        }
    }

    public function create_password()
    {
        if (!$this->session->userdata('ses_otp_ok')) {
            redirect('auth/otp_verification');
        }

        $this->load->model('customer_model');
        $cus_status = $this->customer_model->cus_status($_SESSION['ses_phone']);

        if ($cus_status['is_verified']) {
            redirect('auth/create_profile');
            die;
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'email-input',
            'Email Address',
            'required|is_unique[cd_customer_data.cus_email]',
            array(
                'is_unique'     => '%s already used.'
            )
        );
        $this->form_validation->set_rules('pass-input', 'Password', 'required');
        $this->form_validation->set_rules('conpass-input', 'Password Confirmation', 'required|matches[pass-input]');

        $phone = $this->session->userdata('ses_phone');
        $email = $this->input->post('email-input');
        $pass = password_hash($this->input->post('conpass-input'), PASSWORD_DEFAULT);;

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/page_create_pass');
        } else {
            $this->load->model('auth_model');
            $this->auth_model->auth_create_password($email, $phone, $pass);

            redirect('auth/create_profile');
        }
    }

    public function reset_password()
    {

        $this->load->model('customer_model');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('pass-input', 'Password', 'required');
        $this->form_validation->set_rules('conpass-input', 'Password Confirmation', 'required|matches[pass-input]');

        $email = $this->input->post('email-input');
        $pass = password_hash($this->input->post('conpass-input'), PASSWORD_DEFAULT);;

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/page_reset_pass');
        } else {
            $this->load->model('auth_model');

            redirect('auth/signin');
        }
    }

    public function create_profile()
    {
        // cek apakah sudah bikin profile START //
        $this->load->model('customer_model');
        $cus_status = $this->customer_model->cus_status($_SESSION['ses_phone']);

        if ($cus_status['is_profiled']) {
            redirect('user');
            die;
        }
        // cek apakah sudah bikin profile END //

        $cus_id = $this->customer_model->get_cus_id($_SESSION['ses_phone']);
        if (!$cus_id) {
            redirect('auth/create_password');
            die;
        }
        $this->load->library('form_validation');

        $this->form_validation->set_rules('first-input', 'First Name', 'required');
        $this->form_validation->set_rules('last-input', 'Last Name', 'required');
        $this->form_validation->set_rules('gender-input', 'Gender', 'required');
        $this->form_validation->set_rules('age-input', 'Age Group', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/page_introduce');
        } else {

            $first_input = $this->input->post('first-input');
            $last_input = $this->input->post('last-input');
            $gender_input = $this->input->post('gender-input');
            $age_input = $this->input->post('age-input');
            $this->load->model('auth_model');
            $this->auth_model->auth_create_profile($first_input, $last_input, $gender_input, $age_input, $cus_id);
            $this->session->set_userdata('ses_cusid', $cus_id);
            redirect('user');
        }
    }

    public function resend_otp()
    {
        if (!$this->session->has_userdata('ses_phone')) {
            redirect('auth');
        }
        if ($this->session->has_userdata('ses_verified')) {
            redirect('auth/create_profile');
        }

        $this->load->model('auth_model');
        $latest = $this->auth_model->check_latest_otp($this->session->userdata('ses_phone'));

        if ($latest) {
            $this->session->set_flashdata('verify_otp_msg', "<p class='alert alert-warning'>There is an active OTP sent to (+" . $this->session->userdata('ses_phone') . ") earlier, it is valid for 5 minutes before being able to resend, please check your Whatsapp.</p>");
            redirect('auth/otp_verification?msg=already-have-otp');
        } else {
            $this->load->model('sendtalk_model');
            $this->sendtalk_model->send_otp($this->session->userdata('ses_phone'));
            $this->session->set_flashdata('verify_otp_msg', "<p class='alert alert-warning'>A new OTP has been sent to your Whatsapp (+" . $this->session->userdata('ses_phone') . "), please check your Whatsapp and enter the OTP number below.</p>");
            redirect('auth/otp_verification?msg=new-otp-resend');
        }
    }

    public function clear_session()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }

    /*
    public function checkotp($phone){
        $this->load->model('auth_model');
        $otp_db = $this->auth_model->check_latest_otp($phone);
        print_r($otp_db);
    }

    public function verifotp($phone, $otp){
        $this->load->model('auth_model');
        $otp_db = $this->auth_model->verify_otp($phone, $otp);
        print_r($otp_db);
    }
    */
}
