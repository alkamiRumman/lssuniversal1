<?php

	class Core_model extends CI_Model {
		function __construct() {
			$this->titlesTable = 'titles';
			$this->itemsTable = 'items';
		}

		function totalTitle(){
			$this->db->select('*');
			$this->db->from($this->titlesTable);
			return $this->db->get()->num_rows();
		}

		function totalItem(){
			$this->db->select('*');
			$this->db->from($this->itemsTable);
			return $this->db->get()->num_rows();
		}
		function todayTotalTitle(){
			$this->db->select('*');
			$this->db->from($this->titlesTable);
			$this->db->where('updateAt' , date('yy-m-d'));
			return $this->db->get()->num_rows();
		}

		function todayTotalItem(){
			$this->db->select('*');
			$this->db->from($this->itemsTable);
			$this->db->where('updateAt' , date('yy-m-d'));
			return $this->db->get()->num_rows();
		}

		function getlastTen(){
			$this->db->select('i.*, t.title, t.director, t.actors');
			$this->db->from($this->itemsTable. ' as i');
			$this->db->join($this->titlesTable . ' as t', 'i.titleId = t.id');
			$this->db->order_by('updateAt', 'desc');
			$this->db->limit(10);
			return $this->db->get()->result();
		}
	}
