<?php

	class Title_model extends CI_Model {
		function __construct() {
			$this->titlesTable = 'titles';
		}

		function save($arr) {
			$this->db->insert($this->titlesTable, $arr);
		}

		function update($arr, $id) {
			$this->db->update($this->titlesTable, $arr, array('id' => $id));
		}

		function getTitles() {
			$this->db->select('*');
			$this->db->from($this->titlesTable);
			$this->db->order_by('id', 'ASC');
			return $this->db->get();
		}

		function getTitlesById($id) {
			$this->db->select('*');
			$this->db->from($this->titlesTable);
			$this->db->where('id', $id);
			return $this->db->get()->row();
		}

		function delete($id) {
			$this->db->where('id', $id);
			$this->db->delete($this->titlesTable);
		}

		function checkTitle($title, $year) {
			$this->db->select('title, ReleaseYear');
			$this->db->from($this->titlesTable);
			$this->db->where('title', $title);
			$this->db->where('ReleaseYear', $year);
			return $this->db->get()->first_row();
		}
	}
