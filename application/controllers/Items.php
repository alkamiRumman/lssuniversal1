<?php

	/**
	 * @property Items_model $items
	 */

	class Items extends MY_Controller {
		public $path = '/items';

		function __construct() {
			parent::__construct();
			if (!$this->session->userdata('session')) {
				redirect('site/logout');
			}
			$this->load->model('Items_model', 'items');
		}

		function index() {
			$this->data['title'] = 'Items';
			$this->makeView('/index');
		}

		function add() {
			$this->data['title'] = 'Add Items';
			$this->makeView('/add');
		}

		function get_Titles() {
			$searchTerm = $this->input->post('searchTerm');
			$response = $this->items->getTitles($searchTerm);
			echo json_encode($response);
		}

		function save() {
//			return dnd($_POST);
//			return dnd($_FILES['files']['name']);
			$titleId = $arr['titleId'] = $this->input->post('titleId');
			$format = $arr['format'] = $this->input->post('format');
			$arr['overallCondition'] = $this->input->post('overallCondition');
			$arr['postingTitle'] = $this->input->post('postingTitle');
			$arr['postingSubTitle'] = $this->input->post('postingSubTitle');
			$arr['dimensions'] = $this->input->post('dimensions');
			$arr['quantity'] = $this->input->post('quantity');
			$arr['description'] = $this->input->post('description');
			$arr['conditions'] = $this->input->post('conditions');
			$arr['location'] = $this->input->post('location');
			$arr['lowValue'] = $this->input->post('lowValue');
			$arr['highValue'] = $this->input->post('highValue');
			$arr['status'] = $this->input->post('status');
			$arr['source'] = $this->input->post('source');
			$arr['nationality'] = $this->input->post('nationality');

			$title = $this->items->getTitleById($titleId);
			$item = $this->items->getLastItemId();
			if ($item->num_rows() == '') {
				$itemId = 1;
			} else {
				$itemId = $item->row()->id + 1;
			}
//			return dnp($item->id);
			$path = $title->title . '-' . $title->ReleaseYear . '-' . $title->id;
			$sub = $path . '/' . $format . '-' . $itemId;
			if (!is_dir('images/' . $path)) {
				mkdir('./images/' . $path, 0777, true);
			}
			if (!file_exists('images/' . $sub)) {
				mkdir('./images/' . $sub, 0777, true);
			}
//			return dnp($path);
//			$filesCount = count($_FILES['files']['name']);
//			for ($i = 0; $i < $filesCount; $i++) {
//				$ext = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
//				$name = 'image' . ($i + 1) . '.' . $ext;
//				$_FILES['file']['name'] = $name;
//				$_FILES['file']['type'] = $_FILES['files']['type'][$i];
//				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
//				$_FILES['file']['error'] = $_FILES['files']['error'][$i];
//				$_FILES['file']['size'] = $_FILES['files']['size'][$i];
//				$config['upload_path'] = './images/' . $sub;
//				$config['allowed_types'] = 'jpg|png|jpeg';
//				$config['overwrite'] = true;
////				return dnd($config);
//				if (!is_dir('images/' . $path)) {
//					mkdir('./images/' . $path, 0777, true);
//				}
//				if (!file_exists('images/' . $sub)) {
//					mkdir('./images/' . $sub, 0777, true);
//				}
//				$this->load->library('upload', $config);
////				return dnd($config);
//				$this->upload->initialize($config);
//				if ($this->upload->do_upload('file')) {
//					$fileData = $this->upload->data();
//					$image = explode('/', $config['upload_path'], 3);
//					$arr['image' . ($i + 1)] = $image[2] . '/image' . ($i + 1) . '.' . $ext;
//				}
//			}
//			return dnd($fileData);
			$this->items->save($arr);
			$this->session->set_flashdata('success', 'Item Added Successfully.');
			redirect('items/index');
		}

		function getItems() {
			$action = '<button onclick="loadPopup(\'' . base_url('items/view/$1') . '\')" 
			class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
			<a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('items/edit/$1') . '\')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
            <a href="delete/$1' . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></a>';
			$this->datatables->select('i.id as id, i.image1, t.title, t.ReleaseYear, i.dimensions, i.format, i.quantity, i.nationality, i.description, i.conditions, i.lowValue, i.highValue,
			i.status, i.source, i.oldTitle, i.oldComments, i.oldNotes, i.oldFormat, i.oldYear, i.eBayCategory, i.overallCondition, i.postingTitle, i.postingSubTitle, t.genre, t.country, t.director, 
			t.writer, t.actors, i.location, i.updateAt');
			$this->datatables->from(TABLE_TITLES . ' as t');
			$this->datatables->join(TABLE_ITEMS . ' as i', 't.id = i.titleId');
			$this->datatables->addColumn('actions', $action, 'id');
			$this->datatables->generate();
		}

		function edit($id) {
			$this->data['items'] = $this->items->getItemsById($id);
			$this->data['jsonItem'] = json_encode($this->items->getItemsById($id));
			$this->makeView('/edit');
		}

		function update($id) {
//			return dnp($_POST['preloaded']);
			$titleId = $arr['titleId'] = $this->input->post('titleId');
			$format = $arr['format'] = $this->input->post('format');
			$arr['overallCondition'] = $this->input->post('overallCondition');
			$arr['postingTitle'] = $this->input->post('postingTitle');
			$arr['postingSubTitle'] = $this->input->post('postingSubTitle');
			$arr['dimensions'] = $this->input->post('dimensions');
			$arr['quantity'] = $this->input->post('quantity');
			$arr['description'] = $this->input->post('description');
			$arr['conditions'] = $this->input->post('conditions');
			$arr['location'] = $this->input->post('location');
			$arr['lowValue'] = $this->input->post('lowValue');
			$arr['highValue'] = $this->input->post('highValue');
			$arr['status'] = $this->input->post('status');
			$arr['source'] = $this->input->post('source');
			$arr['nationality'] = $this->input->post('nationality');
			$arr['oldTitle'] = $this->input->post('oldTitle');
			$arr['oldComments'] = $this->input->post('oldComments');
			$arr['oldNotes'] = $this->input->post('oldNotes');
			$arr['oldFormat'] = $this->input->post('oldFormat');
			$arr['oldYear'] = $this->input->post('oldYear');
			$arr['eBayCategory'] = $this->input->post('eBayCategory');
			$arr['updateAt'] = date('yy-m-d H:i:s');

			$title = $this->items->getTitleById($titleId);

			$filesCount = count($_FILES['files']['name']);
			$path = $title->title . '-' . $title->ReleaseYear . '-' . $title->id;
			$sub = $path . '/' . $format . '-' . $id;

			for ($i = 0; $i < $filesCount; $i++) {
				$arr['image' . ($i + 1)] = null;
				if ($this->input->post('preloaded')) {
					$preloaded = $_POST['preloaded'];
					$pre = count($preloaded);
					for ($j = 0; $j < $pre; $j++) {
						$v = explode('/', $_POST['image' . $preloaded[$j]], 7);
						$p = $v[5];
						$arr['image' . ($preloaded[$j])] = $p . '/' . $v[6];
					}
					if ($preloaded == null) {
						$arr['image' . ($i + 1)] = null;
					}
				}
//				if (!$this->input->post('preloaded')) {
//					for ($j = 0; $j < $pre; $j++) {
//						$v = explode('/', $_POST['image' . $preloaded[$j]], 7);
//						$p = $v[5];
//						$arr['image' . ($preloaded[$j])] = $p . '/' . $v[6];
//					}
//				}
				$ext = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
				$name = 'image' . ($i + 1) . '.' . $ext;
				$_FILES['file']['name'] = $name;
				$_FILES['file']['type'] = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['files']['error'][$i];
				$_FILES['file']['size'] = $_FILES['files']['size'][$i];
				$config['upload_path'] = './images/' . $sub;
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['overwrite'] = true;
				if (!is_dir('images/' . $path)) {
					mkdir('./images/' . $path, 0777, true);
				}
				if (!file_exists('images/' . $sub)) {
					mkdir('./images/' . $sub, 0777, true);
				}
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$this->upload->data();
					$image = explode('/', $config['upload_path'], 3);
					$arr['image' . ($i + 1)] = $image[2] . '/image' . ($i + 1) . '.' . $ext;
				}
			}
//			return dnp($arr);
			$this->items->update($arr, $id);
			$this->session->set_flashdata('success', 'Items Update Successfully.');
			redirect('items/index');
		}

		function delete($id) {
			$this->items->delete($id);
			$this->session->set_flashdata('success', 'Item Successfully Removed..');
			redirect('items/index');
		}

		function view($id) {
			$item = $this->data['items'] = $this->items->getItemsById($id);
			$this->data['titles'] = $this->items->getTitleById($item->titleId);
			$this->data['title'] = 'View';
//			return dnp($item);
			$this->makeView('/view');
		}

	}
