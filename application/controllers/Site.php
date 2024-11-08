<?php

/**
 * @property Site_model $site
 */
class Site extends MY_Controller
{
	public $path = '/site';

	function __construct()
	{
		parent::__construct();
		$this->load->model('Site_model', 'site');
	}

	function index()
	{
		$this->ifLogin();
		$this->load->view('site/login');
	}

	function verify()
	{
		$username = $this->input->post("username");
		$pass = $this->input->post("password");
		if ($user = $this->site->getUser($username)) {
			if (md5($pass) == $user->password) {
				$user = (array)$user;
				unset($user["password"]);
				$this->session->set_userdata("user", (object)$user);
				$this->session->set_flashdata('success', 'Login Succeed!');
				$this->ifLogin();
			} else {
				$this->session->set_flashdata('danger', 'Wrong Username or Password..');
				redirect($this->index());
			}
		} else {
			$this->session->set_flashdata('danger', 'User not exists!');
			redirect($this->index());
		}
	}

	function profile()
	{
		$this->data['user'] = getSession();
		$this->popupView('/profile');
	}

	function updateProfile($id)
	{
//			return dnd($_POST);
		$name = $arr['name'] = $this->input->post('name');
		if ($this->input->post('password')) {
			$arr['password'] = md5($this->input->post('password'));
		}
		$config['upload_path'] = './images/' . $id;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['overwrite'] = true;

		if (!is_dir('images')) {
			mkdir('./images', 0777, true);
		}
		if (!is_dir('images/' . $id)) {
			mkdir('./images/' . $id, 0777, true);
		}
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		$this->upload->do_upload('profilePicture');
		$profile = $this->upload->data('file_name');

		if (!empty($_FILES['profilePicture']['name'])) {
			$arr['profilePicture'] = $profile;
			getSession()->profilePicture = $profile;
		}
		$this->site->update($arr, $id);
		getSession()->name = $name;
		$this->session->set_flashdata('success', 'Profile Updated!!');
		redirect(base_url());
	}

	function signUp()
	{
		$this->ifLogin();
		$this->load->view('site/signUp');
	}

	function fetch_email()
	{
		$email = $this->input->post('email');
		if ($email) {
			if ($this->site->fetch_email($email) == true) {
				echo true;
			} else {
				echo false;
			}
		}
	}

	function register()
	{
		$name = $arr['name'] = $this->input->post('name');
		$arr['businessName'] = $this->input->post('businessName');
		$email = $arr['username'] = $this->input->post('username');
		$arr['businessAddress'] = $this->input->post('username');
		$arr['password'] = md5($this->input->post('password'));
		$arr['type'] = 'Vendor';
		if ($this->site->fetch_email($email) == false) {
			$this->email->from('info@rummanitsolution.com', COMPANY);
			$this->email->to($email);
			$this->email->subject('Welcome to the LSS Universal Vendor Network!');
			$this->email->message('<h2>Hello ' . $name . ',</h2><br><p>
					We’re pleased to inform you that you have successfully joined the LSS Universal Vendor Network platform.</p>
					<p>Please log in to update your profile. This will help us better identify your business and the services you may provide for upcoming experiences.</p>
					<p>Updating your profile is crucial for processing future invoices and ensuring timely payments to your business account.</p>
					<p>If you have any questions, please “Contact Us” through the vendor system at <a href="https://live.lssuniversal.com/vendor/updateProfile" target="_blank">https://live.lssuniversal.com</a></p>
					<p>Cheers to collaboration,</p><br>
					<img class="img-responsive center-block" src="' . base_url("images/3.png") . '" height="60" style="margin: 0">');
			if ($this->email->send()) {
				$this->site->saveUser($arr);
				$this->session->unset_userdata('user');
				$user = $this->site->getUser($email);
				$user = (array)$user;
				unset($user['password']); // Remove password from session data for security reasons
				// Set session for the new user
				$this->session->set_userdata('user', (object)$user);
				$this->session->set_flashdata('persistent_success', 'We’re pleased to inform you that you have successfully joined the LSS Universal Vendor Network platform.<br>Please update your profile. This will help us better identify your business and the services you may provide for upcoming experiences.');
				redirect($this->index());
			} else {
				$this->session->set_flashdata('danger', 'Server configuration failed!');
				redirect($this->index());
			}
		} else {
			$this->session->set_flashdata('danger', 'Email already exist!!');
			redirect($this->index());
		}
	}

	function forgetPassword()
	{
		$this->load->view('site/forgetPassword');
	}

	function verifyEmail()
	{
		$email = $this->input->post('email');
		$pass = substr(uniqid(rand(), true), 6, 6);
		if ($user = $this->site->getUser($email)) {
			$arr['password'] = md5($pass);
			$this->email->from('info@rummanitsolution.com', COMPANY);
			$this->email->to($email);
			if ($user->businessName) {
				$this->email->subject('Password Reset for ' . $user->businessName);
			} else {
				$this->email->subject('Password Reset: LSS Universal Portal');
			}
			$this->email->message('<h2>Hello ' . $user->name . ',</h2><br><p>
					As per your request, your new password for accessing the Vendor Network is: ' . $pass . '</p>
					<p>Once logged in, you can update your password by visiting the "Profile" section.</p>
					<p>Log-In Now: <a href="live.lssuniversal.com" target="_blank">live.lssuniversal.com</a></p><br>
					<img class="img-responsive center-block" src="' . base_url("images/3.png") . '" height="60" style="margin: 0">');
			if ($this->email->send()) {
				$this->site->update($arr, $user->id);
				$this->session->set_flashdata('success', 'An email is sent to ' . $email);
				redirect($this->index());
			} else {
				$this->session->set_flashdata('danger', 'Server configuration failed!');
				redirect($this->index());
			}
			$this->site->update($arr, $user->id);
			$this->session->set_flashdata('success', 'An email is sent to ' . $email);
			redirect($this->index());
		} else {
			$this->session->set_flashdata('danger', 'Email not matched!');
			redirect($this->index());
		}
	}

	function viewTimedAccessLink($id)
	{
		$this->data['title'] = 'Timed Access Link';
		$timeAccessLink = $this->data['timedAccessLink'] = $this->site->getTimedAccessLinkDetailsById($id);
		if ($timeAccessLink->status == 0) {
			$this->data['data'] = $this->site->getRunOfShowById($timeAccessLink->runOfShowId);
//		return dnp($timeAccessLink->showProduction);
			if ($timeAccessLink->showProduction == 1) {
				$this->data['runOfShowDetails'] = $this->site->getRunOfShowScheduleDetails($timeAccessLink->runOfShowId);
			}
			$this->data['timedAccessLinkCrewTravel'] = $this->site->getTimedAccessLinkCrewTravelDetailsById($id);
			$this->data['timedAccessLinkTalentTravel'] = $this->site->getTimedAccessLinkTalentTravelDetailsById($id);
			$this->data['timedAccessLinkPOC'] = $this->site->getTimedAccessLinkPocDetailsById($id);
			$this->load->view("header", $this->data);
			$this->load->view('site/viewTimedAccessLink', $this->data);
			$this->load->view('footer', $this->data);
		} else {
			redirect('https://www.legendarystudioshows.com/404');
		}
	}

	function logout()
	{
		$this->session->unset_userdata('user');
		$this->session->set_flashdata('success', 'Successfully Logged Out!!');
		redirect(base_url());
	}

}
