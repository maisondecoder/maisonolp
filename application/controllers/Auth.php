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
        
        $json = file_get_contents('https://gist.githubusercontent.com/kcak11/4a2f22fb8422342b3b3daa7a1965f4e4/raw/3d54c1a6869e2bf35f729881ef85af3f22c74fad/countries.json');
        $obj = json_decode($json, true);
        $data['country_code'] = $obj;

        $this->load->library('form_validation');

        $this->form_validation->set_rules('phone-input', 'Whatsapp Number', 'required|numeric|min_length[10]|max_length[14]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/page_auth_home', $data);
            if($this->session->has_userdata('ses_cusid')){
                redirect('user');
            }else{
                $this->session->sess_destroy();
            }
        } else {
            $phone = $this->input->post('phone-input');
            $dialcode = substr_replace($this->input->post('dialcode'), "", 0, 1);
            $phonefix = $dialcode . $phone;

            $this->session->set_userdata('ses_phone', $phonefix);
            $this->session->set_userdata('ses_phone_input', $phone);
            $this->load->model('auth_model');

            if ($this->auth_model->check_existing_member($phonefix)) {
                $this->session->set_flashdata('login_password', "<p class='alert alert-info'>Your Whatsapp Number (+" . $phonefix . ") is an existing account, enter your password to access your account.</p>");
                redirect('auth/signin');
            } else {
                if (!$this->auth_model->check_latest_otp($phonefix)) {
                    $this->load->model('sendtalk_model');
                    $this->sendtalk_model->send_otp($phonefix);
                    $this->session->set_flashdata('verify_otp_msg', "<p class='alert alert-warning'>We've sent an OTP to your Whatsapp (+" . $phonefix . "), please check your Whatsapp and enter the OTP number below.</p>");
                    redirect('auth/otp_verification?msg=new-otp-sent');
                } else {
                    $this->session->set_flashdata('verify_otp_msg', "<p class='alert alert-warning'>There is an active OTP sent to (+" . $phonefix . ") earlier, it is valid for 5 minutes before being able to resend, please check your Whatsapp.</p>");
                    redirect('auth/otp_verification?msg=already-have-otp');
                }
            }
        }
    }

    public function signin()
    {
        $json = file_get_contents('https://gist.githubusercontent.com/kcak11/4a2f22fb8422342b3b3daa7a1965f4e4/raw/3d54c1a6869e2bf35f729881ef85af3f22c74fad/countries.json');
        $obj = json_decode($json, true);
        $data['country_code'] = $obj;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('pass-input', 'Password', 'required');
        if ($this->session->has_userdata('ses_phone')) {
            $phone = $this->session->userdata('ses_phone_input');
            $data['ses_dialcode_input'] = substr( $this->session->userdata('ses_phone'),0,2);
            $data['ses_phone_input'] = $phone;
        } else {
            $data['ses_dialcode_input'] = 62;
            $data['ses_phone_input'] = null;
            $phone = $this->input->post('phone-input');
        }


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/page_login_existing', $data);
        } else {
            $dialcode = substr_replace($this->input->post('dialcode'), "", 0, 1);
            $phonefix = $dialcode . $phone;
            $pass = $this->input->post('pass-input');

            $this->load->model('customer_model');
            $login = $this->customer_model->login_verify($phonefix, $pass);
            //print_r($phonefix);
            //die;
            if ($login) {
                $this->session->set_userdata('ses_cusid', $login['cus_id']);
                $this->session->set_userdata('ses_logged', true);
                $this->session->set_userdata('ses_phone', $phonefix);
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
            die;
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

    public function forgot_password()
    {

        $json = file_get_contents('https://gist.githubusercontent.com/kcak11/4a2f22fb8422342b3b3daa7a1965f4e4/raw/3d54c1a6869e2bf35f729881ef85af3f22c74fad/countries.json');
        $obj = json_decode($json, true);
        $data['country_code'] = $obj;

        $this->load->model('auth_model');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('phone-input', 'Whatsapp Number', 'required');
        $this->form_validation->set_rules('email-input', 'Email Address', 'required');

        $email = $this->input->post('email-input');
        $phone = $this->input->post('phone-input');
        $dialcode = substr_replace($this->input->post('dialcode'), "", 0, 1);
        $phonefix = $dialcode . $phone;

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/page_forgot_pass_1', $data);
        } else {
            
            $this->load->model('auth_model');
            $check_data = $this->auth_model->auth_check_account_forgot($phonefix, $email);

            if ($check_data) {
                
                $token = $this->auth_model->auth_create_token_reset($check_data);

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
                $this->email->message('You have submitted a password reset request, click the following link to create a new password: <a href="'.base_url().'auth/reset_password/' . $token . '" target="_blank">Create a New Password.</a>');

                $this->email->send();
                
                header( "refresh:7;url=".base_url('auth/signin'));
                $this->load->view('auth/page_forgot_pass_2');
            } else {
                $this->session->set_flashdata("forgot_password_msg", "<p class='alert alert-danger'>The information you provided does not match, please try again.</p>");
                redirect('auth/forgot_password');
            }
        }
    }

    public function reset_password($token = '0')
    {
        if ($token == '0') {
            redirect('auth/forgot_password');
            echo 'reset token is invalid or expired!';
            die;
        } else {
            $this->load->model('auth_model');
            $check_token = $this->auth_model->auth_check_token_reset($token);
            if ($check_token) {
                //echo 'match token';
                //print_r($check_token);
                $data['token'] = $token;
            } else {
                echo 'reset token is invalid or expired!';
                die;
            }
        }

        $this->load->model('customer_model');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('pass-input', 'Password', 'required');
        $this->form_validation->set_rules('conpass-input', 'Password Confirmation', 'required|matches[pass-input]');

        $pass = $this->input->post('conpass-input');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/page_reset_pass', $data);
        } else {
            $this->load->model('auth_model');
            $this->auth_model->auth_change_password($pass, $check_token['cus_id']);
            $this->session->set_flashdata("login_password", "<p class='alert alert-info'>Change password has been successful. Please login using the new password you created.</p>");
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
        $this->form_validation->set_rules('birth-input', 'Date of Birth', 'required');
        $this->form_validation->set_rules('celebrate-input', 'Day Celebrate', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/page_introduce');
        } else {
            $this->load->helper('date');
            $first_input = $this->input->post('first-input');
            $last_input = $this->input->post('last-input');
            $gender_input = $this->input->post('gender-input');
            $birth_input = $this->input->post('birth-input');
            $celebrate_input = $this->input->post('celebrate-input');
            $this->load->model('auth_model');
            $this->load->model('cashier_model');
            $this->auth_model->auth_create_profile($first_input, $last_input, $gender_input, $birth_input, $celebrate_input, $cus_id);
            $this->session->set_userdata('ses_cusid', $cus_id);
            $this->cashier_model->create_pts(50, 0, 'Sign Up Bonus', $cus_id, 1, 'REG' . now());
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
