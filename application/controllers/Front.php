<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Front extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper('date');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function read($slug)
	{
		$this->load->model('post_model');
		$read = $this->post_model->get_single_post($slug);

		if (isset($_GET['preview']) && $_GET['preview'] == '1') {
			$latest = $this->post_model->get_latest_post(3, $read['pa_id']);
			$data['read'] = $read;
			$data['latest'] = $latest;
			$this->load->view('public/header', $data);
			$this->load->view('public/read', $data);
			$this->load->view('public/footer');
		} else {
			if ($read) {
				if ($read['date_publish'] > now() || $read['pa_status'] == '0' || $read['is_deleted'] == '1') {
					//Article Not Found
					$read['pa_title'] = 'Article Not Found';
					$data['read'] = $read;
					$latest = $this->post_model->get_latest_post(10, 0);
					$data['latest'] = $latest;

					$this->load->view('public/header', $data);
					$this->load->view('public/read-not-found', $data);
					$this->load->view('public/footer');
				} else {
					$latest = $this->post_model->get_latest_post(3, $read['pa_id']);
					$data['read'] = $read;
					$data['latest'] = $latest;
					$this->load->view('public/header', $data);
					$this->load->view('public/read', $data);
					$this->load->view('public/footer');
				}
			} else {
				//Article Not Found
				$read['pa_title'] = 'Article Not Found';
				$data['read'] = $read;
				$latest = $this->post_model->get_latest_post(10, 0);
				$data['latest'] = $latest;

				$this->load->view('public/header', $data);
				$this->load->view('public/read-not-found', $data);
				$this->load->view('public/footer');
			}
		}
	}
}
