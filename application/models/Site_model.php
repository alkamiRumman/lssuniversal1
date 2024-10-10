<?php

	class Site_model extends CI_Model {

		public function __construct() {
			parent::__construct();
		}

		function getUser($username) {
			$this->db->select('*');
			$this->db->from(TABLE_USERS);
			$this->db->where(array('username' => $username, 'deleted' => 0));
			$query = $this->db->get();
			if ($query->num_rows()) {
				return $query->row();
			}
			return false;
		}

		function fetch_email($email)
		{
			$this->db->select('username');
			// $this->db->where("username like '%" . $email . "%'");
			$this->db->where(array('username' => $email, 'deleted' => 0));
			$query = $this->db->get(TABLE_USERS);
			if ($query->num_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}

		function saveUser($arr) {
			$this->db->insert(TABLE_USERS, $arr);
		}

		function update($arr, $id){
			$this->db->update(TABLE_USERS, $arr, array('id' => $id));
		}
	}
