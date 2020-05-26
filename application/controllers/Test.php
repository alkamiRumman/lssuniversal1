<?php

	/**
	 * @property Site_model $Site_model
	 */
	class Test extends MY_Controller {
		public $path = '/test';

		function __construct() {
			parent::__construct();
			$this->load->model('Site_model');
			$this->titlesTable = 'titles';
		}

		function index() {
			$this->data['title'] = 'Index Page';
			$this->makeView('/index');
		}

		function getTitles() {
			$action = '<button onclick="loadPopup(\'' . base_url('titles/view/$1') . '\')" 
			class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
			<a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('titles/edit/$1') . '\')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
            <a href="delete/$1' . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></a>';
			$this->datatables->select('id, poster, title, ReleaseYear, genre, director, actors, country, writer, 
			rated,released,runtime,language,type,imdbID,awards,production,plot');
			$this->datatables->from($this->titlesTable);
			$this->datatables->addColumn('actions', $action, 'id');
			$this->datatables->generate();
		}
		function getItems() {
			$action = '<button onclick="loadPopup(\'' . base_url('items/view/$1') . '\')" 
			class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
			<a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('items/edit/$1') . '\')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
            <a href="delete/$1' . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></a>';
			$this->datatables->select('i.id, i.image1, t.title, t.ReleasedYear, i.dimensions, i.format, i.quantity, i.nationality, i.description, i.conditions, i.location, i.lowValue, i.highValue,
			i.source, i.oldTitle, i.oldComments, i.oldNotes, i.oldFormat, i.oldYear, i.overallCondition, i.postingTitle, i.postingSubTitle, t.genre, t.country, t.director, t.writer, t.actors');
			$this->datatables->from(TABLE_TITLES. ' as i');
			$this->datatables->join(TABLE_ITEMS. ' as i', 't.id = i.titleId');
			$this->datatables->addColumn('actions', $action, 'i.id');
			$this->datatables->generate();
		}
	}
