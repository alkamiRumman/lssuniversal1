<?php

	/**
	 * @property Title_model $title
	 */

	class Titles extends MY_Controller {
		public $path = '/titles';

		function __construct() {
			parent::__construct();
			if (!$this->session->userdata('session')) {
				redirect('site/logout');
			}
			$this->load->model('Title_model', 'title');
		}

		function add() {
			$this->data['title'] = 'Add Title';
			$this->makeView('/add');
		}

		function index() {
			$this->data['title'] = 'Titles List';
			$this->makeView('/index');
		}

		function save() {
//			return dnd($_POST);
			$title = $arr['title'] = $this->input->post('title');
			$arr['imdbID'] = $this->input->post('imdbID');
			$arr['type'] = $this->input->post('type');

			if ($this->input->post('ReleaseYear') != '') {
				$year = $arr['ReleaseYear'] = $this->input->post('ReleaseYear');
			} else {
				$arr['ReleaseYear'] = 'N/A';
			}

			if ($this->input->post('genre') != null) {
				$arr['genre'] = json_encode($this->input->post('genre'));
			} else {
				$arr['genre'] = 0;
			}

			if ($this->input->post('rated') != '') {
				$arr['rated'] = $this->input->post('rated');
			} else {
				$arr['rated'] = 'N/A';
			}
			if ($this->input->post('released') != '') {
				$arr['released'] = $this->input->post('released');
			} else {
				$arr['released'] = 'N/A';
			}
			if ($this->input->post('runtime') != '') {
				$arr['runtime'] = $this->input->post('runtime');
			} else {
				$arr['runtime'] = 'N/A';
			}
			if ($this->input->post('director') != '') {
				$arr['director'] = $this->input->post('director');
			} else {
				$arr['director'] = 'N/A';
			}
			if ($this->input->post('writer') != '') {
				$arr['writer'] = $this->input->post('writer');
			} else {
				$arr['writer'] = 'N/A';
			}
			if ($this->input->post('actors') != '') {
				$arr['actors'] = $this->input->post('actors');
			} else {
				$arr['actors'] = 'N/A';
			}
			if ($this->input->post('language') != '') {
				$arr['language'] = $this->input->post('language');
			} else {
				$arr['language'] = 'N/A';
			}
			if ($this->input->post('country') != '') {
				$arr['country'] = $this->input->post('country');
			} else {
				$arr['country'] = 'N/A';
			}
			if ($this->input->post('awards') != '') {
				$arr['awards'] = $this->input->post('awards');
			} else {
				$arr['awards'] = 'N/A';
			}
			if ($this->input->post('production') != '') {
				$arr['production'] = $this->input->post('production');
			} else {
				$arr['production'] = 'N/A';
			}
			if ($this->input->post('plot') != '') {
				$arr['plot'] = $this->input->post('plot');
			} else {
				$arr['plot'] = 'N/A';
			}
			if ($this->input->post('poster') != '') {
				$arr['poster'] = $this->input->post('poster');
			} else {
				$arr['poster'] = base_url('images/noImage.png');
			}
			if ($this->input->post('poster') == 'N/A') {
				$arr['poster'] = base_url('images/noImage.png');
			}

//			$config['upload_path'] = './images/' . $title;
//			$config['allowed_types'] = 'gif|jpg|jpeg|png';
//			$config['overwrite'] = true;
//
//			if (!is_dir('images/' . $title)) {
//				mkdir('./images/' . $title, 0777, true);
//			}
//			$this->upload->initialize($config);
//			$this->load->library('upload', $config);
//			$this->upload->do_upload('poster');
//			$poster = $this->upload->data('file_name');
//
//			if (!empty($_FILES['poster']['name'])) {
//				$arr['poster'] = $poster;
//			}
//return dnd($this->title->checkTitle($title));
			if ($this->title->checkTitle($title, $year)) {
				$this->session->set_flashdata('danger', 'Title Already Exists.');
				redirect($_SERVER['HTTP_REFERER']);
			} else {
//				return dnp($arr);
				$this->title->save($arr);
				$this->session->set_flashdata('success', 'Title Add Successfully.');
				redirect('titles/index');
			}
		}

		function getTitles() {
			$action = '<button onclick="loadPopup(\'' . base_url('titles/view/$1') . '\')" 
			class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
			<a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('titles/edit/$1') . '\')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
            <a href="delete/$1' . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></a>';
			$this->datatables->select('id, poster, title, ReleaseYear, genre, director, actors, country, writer, 
			rated,released,runtime,language,type,imdbID,awards,production,plot');
			$this->datatables->from(TABLE_TITLES);
			$this->datatables->addColumn('actions', $action, 'id');
			$this->datatables->generate();
		}

		function test() {
			$query = $this->title->getTitles();
			foreach ($query->result() as $r) {
				if ($r->poster == 'N/A') {
					echo dnp($r->title);
				}
			}
		}

		function delete($id) {
			$this->title->delete($id);
			$this->session->set_flashdata('success', 'Title Successfully Removed..');
			redirect('titles/index');
		}

		function edit($id) {
			$title = $this->data['titles'] = $this->title->getTitlesById($id);
			$this->makeView('/edit');
		}

		function update($id) {
			$this->title->getTitlesById($id);
//			return dnd($_POST);
			$arr['title'] = $this->input->post('title');
			$arr['ReleaseYear'] = $this->input->post('ReleaseYear');
			$arr['imdbID'] = $this->input->post('imdbID');
			$arr['type'] = $this->input->post('type');
			$arr['genre'] = json_encode($this->input->post('genre'));

			if ($this->input->post('rated') != '') {
				$arr['rated'] = $this->input->post('rated');
			} else {
				$arr['rated'] = 'N/A';
			}
			if ($this->input->post('released') != '') {
				$arr['released'] = $this->input->post('released');
			} else {
				$arr['released'] = 'N/A';
			}
			if ($this->input->post('runtime') != '') {
				$arr['runtime'] = $this->input->post('runtime');
			} else {
				$arr['runtime'] = 'N/A';
			}
			if ($this->input->post('director') != '') {
				$arr['director'] = $this->input->post('director');
			} else {
				$arr['director'] = 'N/A';
			}
			if ($this->input->post('writer') != '') {
				$arr['writer'] = $this->input->post('writer');
			} else {
				$arr['writer'] = 'N/A';
			}
			if ($this->input->post('actors') != '') {
				$arr['actors'] = $this->input->post('actors');
			} else {
				$arr['actors'] = 'N/A';
			}
			if ($this->input->post('language') != '') {
				$arr['language'] = $this->input->post('language');
			} else {
				$arr['language'] = 'N/A';
			}
			if ($this->input->post('country') != '') {
				$arr['country'] = $this->input->post('country');
			} else {
				$arr['country'] = 'N/A';
			}
			if ($this->input->post('awards') != '') {
				$arr['awards'] = $this->input->post('awards');
			} else {
				$arr['awards'] = 'N/A';
			}
			if ($this->input->post('production') != '') {
				$arr['production'] = $this->input->post('production');
			} else {
				$arr['production'] = 'N/A';
			}
			if ($this->input->post('plot') != '') {
				$arr['plot'] = $this->input->post('plot');
			} else {
				$arr['plot'] = 'N/A';
			}
			if ($this->input->post('poster') != '') {
				$arr['poster'] = $this->input->post('poster');
			} else {
				$arr['poster'] = 'N/A';
			}
			$arr['updateAt'] = date('yy-m-d');


//			$config['upload_path'] = './images/' . $title;
//			$config['allowed_types'] = 'gif|jpg|jpeg|png';
//			$config['overwrite'] = true;
//
//			if (!is_dir('images/' . $title)) {
//				mkdir('./images/' . $title, 0777, true);
//			}
//			$this->upload->initialize($config);
//			$this->load->library('upload', $config);
//			$this->upload->do_upload('poster');
//			$poster = $this->upload->data('file_name');
//
//			if (!empty($_FILES['poster']['name'])) {
//				$arr['poster'] = $poster;
//			}
//return dnd($this->title->checkTitle($title));

			$this->title->update($arr, $id);
			$this->session->set_flashdata('success', 'Title Update Successfully.');
			redirect('titles/index');
		}


		function view($id) {
			$this->data['titles'] = $this->title->getTitlesById($id);
			$this->data['title'] = 'View';
//			return dnp($title);
			$this->makeView('/view');
		}

	}
