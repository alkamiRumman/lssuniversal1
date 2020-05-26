<?php

	function getLanguage($langId = false) {
		$lan = get_instance();
		if ($langId) {
			$lan->utility->language[$langId];
		} else {
			return $lan->utility->language;
		}
	}

	function dnd($var){
		echo '<pre style="border-top: 2px solid red; border-bottom: 2px solid green; margin: 5px 0">';
		var_dump($var);
		echo '</pre>';
	}

	function login_url($url){
		echo base_url('site/'.$url);
	}

	function dashboard_url($url){
		echo base_url('dashboard/'.$url);
	}

	function titles_url($url){
		echo base_url('titles/'.$url);
	}

	function items_url($url){
	echo base_url('items/'.$url);
}

	function dnp($var){
		echo '<pre style="border-top: 2px solid red; border-bottom: 2px solid green; margin: 5px 0">';
		print_r($var);
		echo '</pre>';
	}

	function sendJson($data) {
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	function maskNumber($number){
		echo substr($number, 0, 2).str_repeat("x", strlen($number)-6) . substr($number, -4);
	}
