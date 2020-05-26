<?php

	/**
	 * @property Core_model $core
	 */
	class Dashboard extends MY_Controller {
		public $path = '/dashboard';

		function __construct() {
			parent::__construct();
			if (!$this->session->userdata('session')) {
				redirect('site/logout');
			}
			$this->load->model('Core_model', 'core');
		}

		function index() {
			$this->data['title'] = 'Dashboard';
			$this->data['totalTitles'] = $this->core->totalTitle();
			$this->data['totalItems'] = $this->core->totalItem();
			$this->data['todayTotalTitles'] = $this->core->todayTotalTitle();
			$this->data['todayTotalItems'] = $this->core->todayTotalItem();
			$this->data['lastTen'] = $this->core->getlastTen();
			$this->makeView('/index');
		}


	}
