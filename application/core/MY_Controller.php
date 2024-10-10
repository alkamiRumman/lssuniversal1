<?php

/**
 * @property Core_model $core
 */

class MY_Controller extends CI_Controller
{
	public $path;
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		$config['protocol'] = 'mail';
		$config['smtp_host'] = 'ssl://rummanitsolution.com';
		$config['smtp_user'] = 'info@rummanitsolution.com';
		$config['smtp_pass'] = 'OTee!(+G33Z[';
		$config['smtp_port'] = '587';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		date_default_timezone_set('America/Los_Angeles');
		$this->load->model('Core_model', 'core');
	}

	function redirectToUrl($url)
	{
		return redirect($url);
	}

	public function makeView($view)
	{
		$this->load->view("header", $this->data);
		$this->load->view("navbar", $this->data);
		$this->load->view($this->path . $view, $this->data);
		$this->load->view('footer', $this->data);
	}

	public function popupView($view)
	{
		$this->load->view($this->path . $view, $this->data);
	}

	function getUserData()
	{
		return isset($_SESSION["user"]) ? $_SESSION["user"] : false;
	}

	function getUserDataType()
	{
		return $this->getUserData()->type;
	}

	function ifLogin()
	{
		if ($this->getUserData()) {
			if ($this->getUserDataType() == 'Admin') {
				$url = 'admin/index';
			} else if ($this->getUserDataType() == 'Customer') {
				$url = 'customer/index';
			} else {
				$url = 'vendor/index';
			}
			return redirect($url);
		}
	}

	function ifNotLogin()
	{
		if (!$this->getUserData()) {
			$request_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
			$this->session->set_flashdata('danger', 'Access Protected');
			return $this->redirectToUrl(login_url('index') . "?redirect=" . $request_link, "Access Protected!<br>Please Login");
		}
	}

	function ifNotAdmin()
	{
		if ($this->getUserDataType() != 'Admin') {
			redirect();
		}
	}

	function ifNotCustomer()
	{
		if ($this->getUserDataType() != 'Customer') {
			redirect();
		}
	}

	function ifNotVendor()
	{
		if ($this->getUserDataType() != 'Vendor') {
			redirect();
		}
	}

}
