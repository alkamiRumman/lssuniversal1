<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Items_model extends CI_Model {

		function __construct() {
			$this->titlesTable = 'titles';
			$this->itemsTable = 'items';
		}

		// for select2
		function getTitles($searchTerm = "") {
			$this->db->select('*');
			$this->db->where("title like '%" . $searchTerm . "%' ");
			$this->db->from($this->titlesTable);
			$users = $this->db->get()->result_array();
			$data = array();
			foreach ($users as $user) {
				$data[] = array("id" => $user['id'], "text" => $user['title'], "year" => $user['ReleaseYear'],
					"director" => $user['director'], "writer" => $user['writer'], "actors" => $user['actors'],
					"rated" => $user['rated'], "released" => $user['released'], "runtime" => $user['runtime'],
					"language" => $user['language'], "country" => $user['country'], "type" => $user['type'],
					"awards" => $user['awards'], "genre" => $user['genre'], "production" => $user['production'],
					"poster" => $user['poster']);
			}
			return $data;
		}

		function get_items() {
			$this->db->select('i.*, t.title as title, t.ReleaseYear as ReleaseYear, t.genre as genre, t.country as country,
			t.director as director, t.writer as writer, t.actors as actors');
			$this->db->from($this->itemsTable . ' as i');
			$this->db->join($this->titlesTable . ' as t', 'i.titleId = t.id');
			return $this->db->get();
		}

		public function totalItems() {
			$query = $this->db->select("COUNT(*) as num")->get($this->itemsTable);
			$result = $query->row();
			if (isset($result)) return $result->num;
			return 0;
		}

		function getTitleById($id) {
			$this->db->select('*');
			$this->db->from($this->titlesTable);
			$this->db->where('id', $id);
			return $this->db->get()->row();
		}

		function getItemsById($id) {
			$this->db->select('i.*, t.title');
			$this->db->from($this->itemsTable . ' as i');
			$this->db->join($this->titlesTable . ' as t', 'i.titleId = t.id');
			$this->db->where('i.id', $id);
			return $this->db->get()->row();
		}

		function getLastItemId() {
			$this->db->select('id');
			$this->db->from($this->itemsTable);
			$this->db->order_by('id', 'desc');
			$this->db->limit(1);
			return $this->db->get();
		}

		function save($arr) {
			$this->db->insert($this->itemsTable, $arr);
		}

		function update($arr, $id) {
			$this->db->update($this->itemsTable, $arr, array('id' => $id));
		}

		function delete($id) {
			$this->db->where('id', $id);
			$this->db->delete($this->itemsTable);
		}
	}
