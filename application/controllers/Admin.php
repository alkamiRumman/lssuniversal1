<?php

/**
 * @property Admin_model $admin
 */
class Admin extends MY_Controller
{
	public $path = '/admin';

	function __construct()
	{
		parent::__construct();
		$this->ifNotLogin();
		$this->ifNotAdmin();
		$this->load->model('Admin_model', 'admin');
	}

	function index()
	{
		$this->data['title'] = 'Dashboard';
		$this->data['totalUser'] = $this->admin->totalUser();
		$this->data['totalVendor'] = $this->admin->totalVendor();
		$this->data['totalCompleteProduction'] = $this->admin->totalCompleteProduction();
		$this->data['totalIncompleteProduction'] = $this->admin->totalIncompleteProduction();

		$query1 = $this->db->query("SELECT COUNT(p.id) as totalComplete, u.name FROM productions p join venues v on p.venueId = v.id join users u on p.addedBy = u.id where p.completedStatus = 'Complete' GROUP BY p.addedBy")->result();
		$query2 = $this->db->query("SELECT COUNT(p.id) as totalIncomplete, u.name FROM productions p join venues v on p.venueId = v.id join users u on p.addedBy = u.id where p.completedStatus = 'In-progress' GROUP BY p.addedBy")->result();

//		return dnp($query2);
		$result = array();
		$data1 = array();


		foreach (array_merge($query1, $query2) as $entry) {
			if (!isset($result[$entry->name])) {
				$result[$entry->name] = $entry;
			} else {
				foreach ($entry as $key => $value) {
					$result[$entry->name]->$key = $value;
				}
			}
		}

//		return dnp($result);

		foreach ($result as $row) {
//			return dnp($row);
			$data1['label'][] = $row->name;
			$data1['totalComplete'][] = isset($row->totalComplete) ? $row->totalComplete : 0;
			$data1['totalIncomplete'][] = isset($row->totalIncomplete) ? $row->totalIncomplete : 0;
		}
//		return dnp($data1);
		if ($data1) {
			$this->data['data1'] = json_encode($data1);
		}
		$this->data['totalInvoices'] = $this->admin->totalInvoices();
		$this->data['totalPaidInvoices'] = $this->admin->totalPaidInvoices();
		$this->data['totalUnpaidInvoices'] = $this->admin->totalUnpaidInvoices();
		$this->data['totalRejectedInvoices'] = $this->admin->totalRejectedInvoices();
		$this->makeView('/index');
	}

	function customers()
	{
		$this->data['title'] = 'Customers';
		$this->makeView('/customers');
	}

	function vendors()
	{
		$this->data['title'] = 'Vendors';
		$this->makeView('/vendors');
	}

	function fetch_email()
	{
		$email = $this->input->post('email');
		if ($email) {
			if ($this->admin->fetch_email($email) == true) {
				echo true;
			} else {
				echo false;
			}
		}
	}

	function saveCustomer()
	{
//		return dnp($_POST);
		$arr['name'] = $this->input->post('name');
		$arr['type'] = $this->input->post('type');
		$arr['phone'] = $this->input->post('phone');
		if ($this->input->post('type') == 'Vendor') {
			$arr['businessName'] = $this->input->post('businessName');
			$arr['ein'] = $this->input->post('ein');
			$arr['businessAddress'] = $this->input->post('businessAddress');
			$arr['city'] = $this->input->post('city');
			$arr['state'] = $this->input->post('state');
			$arr['zip'] = $this->input->post('zip');
			$arr['businessLine1'] = $this->input->post('businessLine1');
			$arr['service1'] = $this->input->post('service1');
			$arr['businessLine2'] = $this->input->post('businessLine2');
			$arr['service2'] = $this->input->post('service2');
			$arr['businessLine3'] = $this->input->post('businessLine3');
			$arr['service3'] = $this->input->post('service3');
		}
		$arr['username'] = $this->input->post('username');
		$arr['password'] = md5($this->input->post('password'));
		$this->admin->saveCustomer($arr);
		$this->session->set_flashdata('success', 'User Added Successfully.');
		redirect('admin/customers');
	}

	function getCustomers()
	{
		$action = '<a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/editCustomer/$1') . '\')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
            <a href="deleteCustomer/$1' . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></a>';
		$this->datatables->select('id, name, username, phone, type, createAt, updateAt');
		$this->datatables->from(TABLE_USERS);
		$this->datatables->where(array('id !=' => getSession()->id, 'type !=' => 'Vendor', 'deleted' => 0));
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}

	function updateAdminAccess()
	{
		$id = $this->input->post('id');
		$arr['type'] = $this->input->post('value');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateCustomer($arr, $id);
		echo json_encode(array('status' => 'success'));
	}

	function getVendors()
	{
		$action = '<div class="dropdown">
			<button class="btn btn-sm dropdown-toggle" style="color: white; background-color: black" type="button" data-toggle="dropdown">Actions
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
			  <li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/viewCustomer/$1') . '\')">View</a></li>
			  <li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/editCustomer/$1') . '\')">Edit</a></li>
			<li><a href="' . base_url('admin/deleteCustomer/$1') . '" onclick="return confirm(\'Are you sure?\')">Delete</a></li>
			</ul>
		  </div>';
		$this->datatables->select('id, name, username, phone, type, businessName, ein, businessAddress, city, state, zip, businessLine1, service1, businessLine2, service2, businessLine3, service3, w9Form, createAt, updateAt');
		$this->datatables->from(TABLE_USERS);
		$this->datatables->where(array('type' => 'Vendor', 'deleted' => 0));
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}

	function getCustomerSearch()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response = $this->admin->getCustomerSearch($searchTerm);
		echo json_encode($response);
	}

	function editCustomer($id)
	{
		$this->data['data'] = $this->admin->getCustomerById($id);
		$this->popupView('/editCustomer');
	}

	function viewCustomer($id)
	{
		$this->data['data'] = $this->admin->getCustomerById($id);
		$this->popupView('/viewCustomer');
	}

	function updateCustomer($id)
	{
		$arr['name'] = $this->input->post('name');
		$arr['type'] = $this->input->post('type');
		$arr['phone'] = $this->input->post('phone');
		$arr['businessName'] = $this->input->post('businessName');
		$arr['ein'] = $this->input->post('ein');
		$arr['businessAddress'] = $this->input->post('businessAddress');
		$arr['city'] = $this->input->post('city');
		$arr['state'] = $this->input->post('state');
		$arr['zip'] = $this->input->post('zip');
		$arr['businessLine1'] = $this->input->post('businessLine1');
		$arr['service1'] = $this->input->post('service1');
		$arr['businessLine2'] = $this->input->post('businessLine2');
		$arr['service2'] = $this->input->post('service2');
		$arr['businessLine3'] = $this->input->post('businessLine3');
		$arr['service3'] = $this->input->post('service3');
		if ($this->input->post('username')) {
			$arr['username'] = $this->input->post('username');
		}
		if ($this->input->post('password')) {
			$arr['password'] = md5($this->input->post('password'));
		}
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateCustomer($arr, $id);
//			$this->session->set_flashdata('danger', 'Not Permitted!!');
		$this->session->set_flashdata('success', 'Updated Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function deleteCustomer($id)
	{
//		$this->admin->deleteUser($id);
//			$this->session->set_flashdata('danger', 'Not Permitted!!');
		$arr['deleted'] = 1;
		$this->admin->updateCustomer($arr, $id);
		$this->session->set_flashdata('success', 'Successfully Removed..');
		redirect($_SERVER['HTTP_REFERER']);
	}

	// add
	function add()
	{
		$this->data['title'] = 'Add Production';
//		$id = $this->data['id'] = $this->admin->getLastProductionIDByUser() ? ($this->admin->getLastProductionIDByUser()->status == 1 ?
//			$this->admin->getLastProductionIDByUser()->id + 1 : $this->admin->getLastProductionIDByUser()->id) : 1;

		$id = $this->data['id'] = getSession()->runningProductionId > 0 ? getSession()->runningProductionId : ($this->admin->getLastProductionID() ? ($this->admin->getLastProductionID()->id + 1) : 1);
//		return dnp(getSession());
//		return dnp(!$this->admin->getProductionCheckById($id));
		if (!$this->admin->getProductionCheckById($id)) {
			getSession()->runningProductionId = $ar['runningProductionId'] = $id;
			$arr['id'] = $id;
			$arr['addedBy'] = getSession()->id;
//			$arr['customerStatus'] = 0;
//			$arr['adminStatus'] = 1;
			$this->admin->updateCustomer($ar, getSession()->id);
			$this->admin->save($arr);
		}
		$this->data['data'] = $this->admin->getProductionById($id);
		$this->data['crewData'] = $this->admin->getCrewMemberByProductionId($id);
		$this->data['entertainerData'] = $this->admin->getEntertainerByProductionId($id);
		$this->data['theatreCrewData'] = $this->admin->getTheatreCrewByProductionId($id);
		$this->data['marketingFeeData'] = $this->admin->getMarketingFeeByProductionId($id);
		$this->data['rentalAndMiscData'] = $this->admin->getRentalAndMiscByProductionId($id);
		$this->makeView('/add');
	}

	function getVenueSearch()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response = $this->admin->getVenueSearch($searchTerm);
		echo json_encode($response);
	}

	function save()
	{
		$id = $this->input->post('id');
		$arr['title'] = $this->input->post('title');
		$arr['eventMonth'] = $this->input->post('eventMonth');
		$arr['eventYear'] = $this->input->post('eventYear');
		$arr['venueId'] = $this->input->post('venueId');
		$arr['rentalFee'] = $this->input->post('rentalFee');
		$arr['backLine'] = $this->input->post('backLine');
		$arr['totalRentalFee'] = $this->input->post('totalRentalFee');
		$arr['ticketFee'] = $this->input->post('ticketFee');
		$arr['serviceFee'] = $this->input->post('serviceFee');
		$arr['totalTicketFee'] = $this->input->post('totalTicketFee');
		$arr['productionFee'] = $this->input->post('productionFee');
		$arr['originationFee'] = $this->input->post('originationFee');
		$arr['coi'] = $this->input->post('coi');
		$arr['totalProductionFee'] = $this->input->post('totalProductionFee');
		$arr['standing'] = $this->input->post('standing');
		$arr['orchesta'] = $this->input->post('orchesta');
		$arr['mezzanine'] = $this->input->post('mezzanine');
		$arr['balcony'] = $this->input->post('balcony');
		$arr['totalVenueCapacity'] = $this->input->post('totalVenueCapacity');
		$arr['totalCrewCost'] = $this->input->post('totalCrewCost');
		$arr['totalEntertainerCost'] = $this->input->post('totalEntertainerCost');
		$arr['totalTheatreCrewCost'] = $this->input->post('totalTheatreCrewCost');
		$arr['graphicDesign'] = $this->input->post('graphicDesign');
		$arr['radio'] = $this->input->post('radio');
		$arr['television'] = $this->input->post('television');
		$arr['billboard'] = $this->input->post('billboard');
		$arr['facebook'] = $this->input->post('facebook');
		$arr['instagram'] = $this->input->post('instagram');
		$arr['twitter'] = $this->input->post('twitter');
		$arr['tikTok'] = $this->input->post('tikTok');
		$arr['printing'] = $this->input->post('printing');
		$arr['trailerPromo'] = $this->input->post('trailerPromo');
		$arr['other'] = $this->input->post('other');
		$arr['totalAdvertising'] = $this->input->post('totalAdvertising');
		$arr['totalMarketingFees'] = $this->input->post('totalMarketingFees');
		$arr['totalRentalAndMiscFees'] = $this->input->post('totalRentalAndMiscFees');
		$arr['totalProductionCost'] = $this->input->post('totalProductionCost');
		$arr['finalTotalTicketFee'] = $this->input->post('finalTotalTicketFee');
		$arr['overallProductionCost'] = $this->input->post('overallProductionCost');
		$arr['baseTicketPrice'] = $this->input->post('baseTicketPrice');
		$arr['ticketMarkup'] = $this->input->post('ticketMarkup');
		$arr['newTicketPrice'] = $this->input->post('newTicketPrice');
		$arr['projectedROI'] = $this->input->post('projectedROI');
		$arr['status'] = 1;
		$arr['customerStatus'] = 0;
		$arr['adminStatus'] = 1;
		if ($this->admin->getProductionCheckById($id)) {
			$arr['updateAt'] = date('Y-m-d H:i:s');
			$this->admin->update($arr, $id);
			$ar['runningProductionId'] = getSession()->runningProductionId = 0;
		} else {
			$arr['id'] = $id;
			$arr['addedBy'] = getSession()->id;
			$this->admin->save($arr);
			$ar['runningProductionId'] = getSession()->runningProductionId = $id;
		}
		$this->admin->updateCustomer($ar, getSession()->id);
		$this->session->set_flashdata('success', 'Production Added Successfully.');
		redirect('admin/productions');
	}

	function saveProgress()
	{

		$id = $this->input->post('id');
		$arr['title'] = $this->input->post('title');
		$arr['eventMonth'] = $this->input->post('eventMonth');
		$arr['eventYear'] = $this->input->post('eventYear');
		$arr['venueId'] = $this->input->post('venueId');
		$arr['rentalFee'] = $this->input->post('rentalFee');
		$arr['backLine'] = $this->input->post('backLine');
		$arr['totalRentalFee'] = $this->input->post('totalRentalFee');
		$arr['ticketFee'] = $this->input->post('ticketFee');
		$arr['serviceFee'] = $this->input->post('serviceFee');
		$arr['totalTicketFee'] = $this->input->post('totalTicketFee');
		$arr['productionFee'] = $this->input->post('productionFee');
		$arr['originationFee'] = $this->input->post('originationFee');
		$arr['coi'] = $this->input->post('coi');
		$arr['totalProductionFee'] = $this->input->post('totalProductionFee');
		$arr['standing'] = $this->input->post('standing');
		$arr['orchesta'] = $this->input->post('orchesta');
		$arr['mezzanine'] = $this->input->post('mezzanine');
		$arr['balcony'] = $this->input->post('balcony');
		$arr['totalVenueCapacity'] = $this->input->post('totalVenueCapacity');
		$arr['totalCrewCost'] = $this->input->post('totalCrewCost');
		$arr['totalEntertainerCost'] = $this->input->post('totalEntertainerCost');
		$arr['totalTheatreCrewCost'] = $this->input->post('totalTheatreCrewCost');
		$arr['graphicDesign'] = $this->input->post('graphicDesign');
		$arr['radio'] = $this->input->post('radio');
		$arr['television'] = $this->input->post('television');
		$arr['billboard'] = $this->input->post('billboard');
		$arr['facebook'] = $this->input->post('facebook');
		$arr['instagram'] = $this->input->post('instagram');
		$arr['twitter'] = $this->input->post('twitter');
		$arr['tikTok'] = $this->input->post('tikTok');
		$arr['printing'] = $this->input->post('printing');
		$arr['trailerPromo'] = $this->input->post('trailerPromo');
		$arr['other'] = $this->input->post('other');
		$arr['totalAdvertising'] = $this->input->post('totalAdvertising');
		$arr['totalMarketingFees'] = $this->input->post('totalMarketingFees');
		$arr['totalRentalAndMiscFees'] = $this->input->post('totalRentalAndMiscFees');
		$arr['totalProductionCost'] = $this->input->post('totalProductionCost');
		$arr['finalTotalTicketFee'] = $this->input->post('finalTotalTicketFee');
		$arr['overallProductionCost'] = $this->input->post('overallProductionCost');
		$arr['baseTicketPrice'] = $this->input->post('baseTicketPrice');
		$arr['ticketMarkup'] = $this->input->post('ticketMarkup');
		$arr['newTicketPrice'] = $this->input->post('newTicketPrice');
		$arr['projectedROI'] = $this->input->post('projectedROI');
		$arr['customerStatus'] = 0;
		$arr['adminStatus'] = 1;
		if ($this->admin->getProductionCheckById($id)) {
			$arr['updateAt'] = date('Y-m-d H:i:s');
			$this->admin->update($arr, $id);
		} else {
			$arr['id'] = $id;
			$arr['addedBy'] = getSession()->id;
			$this->admin->save($arr);
			$productionId = $this->db->insert_id();
			$ar['runningProductionId'] = getSession()->runningProductionId = $productionId;
			$this->admin->updateCustomer($ar, getSession()->id);
		}
	}

	function productionMarkRead($id)
	{
		$arr['customerStatus'] = 0;
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->update($arr, $id);
		$this->session->set_flashdata('success', 'Production Marked as Read Successfully.');
		redirect('admin/productions');
	}

	// crew member
	function addCrewMember($id)
	{
		$this->data['id'] = $id;
		$this->popupView('/addCrewMember');
	}

	function saveCrew($id)
	{
//		return dnd($_POST);
		$arr['productionId'] = $id;
		$arr['firstName'] = $this->input->post('firstName');
		$arr['lastName'] = $this->input->post('lastName');
		$arr['role'] = $this->input->post('role');
		$arr['rate'] = $this->input->post('rate');
		$arr['hotelName'] = $this->input->post('hotelName');
		$arr['hotelNightlyRate'] = $this->input->post('hotelNightlyRate');
		$arr['totalNight'] = $this->input->post('totalNight');
		$arr['perDiem'] = $this->input->post('perDiem');
		$arr['airline'] = $this->input->post('airline');
		$arr['airlineFrom'] = $this->input->post('airlineFrom');
		$arr['airlineTo'] = $this->input->post('airlineTo');
		$arr['airlineTicketType'] = $this->input->post('airlineTicketType');
		$arr['rountTrip'] = $this->input->post('rountTrip');
		$arr['ticketCost'] = $this->input->post('ticketCost');
		$arr['groundTransCo'] = $this->input->post('groundTransCo');
		$arr['groundTransCost'] = $this->input->post('groundTransCost');
		$arr['miscFee'] = $this->input->post('miscFee');
		$arr['equipmentRental'] = $this->input->post('equipmentRental');
		$arr['crewNotes'] = $this->input->post('crewNotes');
		$arr['crewCost'] = $this->input->post('crewCost');
		$this->admin->saveCrewMember($arr);
	}

	function editCrewMember($id)
	{
		$this->data['data'] = $this->admin->getCrewMemberById($id);
		$this->popupView('/editCrewMember');
	}

	function updateCrewMember($id)
	{
		$arr['firstName'] = $this->input->post('firstName');
		$arr['lastName'] = $this->input->post('lastName');
		$arr['role'] = $this->input->post('role');
		$arr['rate'] = $this->input->post('rate');
		$arr['hotelName'] = $this->input->post('hotelName');
		$arr['hotelNightlyRate'] = $this->input->post('hotelNightlyRate');
		$arr['totalNight'] = $this->input->post('totalNight');
		$arr['perDiem'] = $this->input->post('perDiem');
		$arr['airline'] = $this->input->post('airline');
		$arr['airlineFrom'] = $this->input->post('airlineFrom');
		$arr['airlineTo'] = $this->input->post('airlineTo');
		$arr['airlineTicketType'] = $this->input->post('airlineTicketType');
		$arr['rountTrip'] = $this->input->post('rountTrip');
		$arr['ticketCost'] = $this->input->post('ticketCost');
		$arr['groundTransCo'] = $this->input->post('groundTransCo');
		$arr['groundTransCost'] = $this->input->post('groundTransCost');
		$arr['miscFee'] = $this->input->post('miscFee');
		$arr['equipmentRental'] = $this->input->post('equipmentRental');
		$arr['crewNotes'] = $this->input->post('crewNotes');
		$arr['crewCost'] = $this->input->post('crewCost');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateCrewMember($arr, $id);
	}

	function deleteCrewMember($id)
	{
		$this->admin->deleteCrewMember($id);
	}

	// theatre Crew
	function addTheatreCrew($id)
	{
		$this->data['id'] = $id;
		$this->popupView('/addTheatreCrew');
	}

	function saveTheatreCrew($id)
	{
//		return dnd($_POST);
		$arr['productionId'] = $id;
		$arr['memberTitle'] = $this->input->post('memberTitle');
		$arr['hourlyRate'] = $this->input->post('hourlyRate');
		$arr['laborHour'] = $this->input->post('laborHour');
		$arr['total'] = $this->input->post('total');
		$this->admin->saveTheatreCrew($arr);
	}

	function editTheatreCrew($id)
	{
		$this->data['data'] = $this->admin->getTheatreCrewById($id);
		$this->popupView('/editTheatreCrew');
	}

	function updateTheatreCrew($id)
	{
		$arr['memberTitle'] = $this->input->post('memberTitle');
		$arr['hourlyRate'] = $this->input->post('hourlyRate');
		$arr['laborHour'] = $this->input->post('laborHour');
		$arr['total'] = $this->input->post('total');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateTheatreCrew($arr, $id);
	}

	function deleteTheatreCrew($id)
	{
		$this->admin->deleteTheatreCrew($id);
	}

	// entertainer
	function addEntertainer($id)
	{
		$this->data['id'] = $id;
		$this->popupView('/addEntertainer');
	}

	function saveEntertainer($id)
	{
//		return dnd($_POST);
		$arr['productionId'] = $id;
		$arr['firstName'] = $this->input->post('firstName');
		$arr['lastName'] = $this->input->post('lastName');
		$arr['role'] = $this->input->post('role');
		$arr['bookingFee'] = $this->input->post('bookingFee');
		$arr['hotelName'] = $this->input->post('hotelName');
		$arr['hotelNightlyRate'] = $this->input->post('hotelNightlyRate');
		$arr['totalNight'] = $this->input->post('totalNight');
		$arr['perDiem'] = $this->input->post('perDiem');
		$arr['airline'] = $this->input->post('airline');
		$arr['airlineFrom'] = $this->input->post('airlineFrom');
		$arr['airlineTo'] = $this->input->post('airlineTo');
		$arr['airlineTicketType'] = $this->input->post('airlineTicketType');
		$arr['rountTrip'] = $this->input->post('rountTrip');
		$arr['ticketCost'] = $this->input->post('ticketCost');
		$arr['groundTransCo'] = $this->input->post('groundTransCo');
		$arr['groundTransCost'] = $this->input->post('groundTransCost');
		$arr['miscFee'] = $this->input->post('miscFee');
		$riderFee = $arr['riderFee'] = $this->input->post('riderFee');
		$entertainerNotes = $arr['entertainerNotes'] = $this->input->post('entertainerNotes');
		$entertainerCost = $arr['entertainerCost'] = $this->input->post('entertainerCost');
		$this->admin->saveEntertainer($arr);
	}

	function editEntertainer($id)
	{
		$this->data['data'] = $this->admin->getEntertainerById($id);
		$this->popupView('/editEntertainer');
	}

	function updateEntertainer($id)
	{
		$arr['firstName'] = $this->input->post('firstName');
		$arr['lastName'] = $this->input->post('lastName');
		$arr['role'] = $this->input->post('role');
		$arr['bookingFee'] = $this->input->post('bookingFee');
		$arr['hotelName'] = $this->input->post('hotelName');
		$arr['hotelNightlyRate'] = $this->input->post('hotelNightlyRate');
		$arr['totalNight'] = $this->input->post('totalNight');
		$arr['perDiem'] = $this->input->post('perDiem');
		$arr['airline'] = $this->input->post('airline');
		$arr['airlineFrom'] = $this->input->post('airlineFrom');
		$arr['airlineTo'] = $this->input->post('airlineTo');
		$arr['airlineTicketType'] = $this->input->post('airlineTicketType');
		$arr['rountTrip'] = $this->input->post('rountTrip');
		$arr['ticketCost'] = $this->input->post('ticketCost');
		$arr['groundTransCo'] = $this->input->post('groundTransCo');
		$arr['groundTransCost'] = $this->input->post('groundTransCost');
		$arr['miscFee'] = $this->input->post('miscFee');
		$riderFee = $arr['riderFee'] = $this->input->post('riderFee');
		$entertainerNotes = $arr['entertainerNotes'] = $this->input->post('entertainerNotes');
		$entertainerCost = $arr['entertainerCost'] = $this->input->post('entertainerCost');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateEntertainer($arr, $id);
	}

	function deleteEntertainer($id)
	{
		$this->admin->deleteEntertainer($id);
	}

	// Marketing Fee
	function addMarketingFee($id)
	{
		$this->data['id'] = $id;
		$this->popupView('/addMarketingFee');
	}

	function saveMarketingFee($id)
	{
//		return dnd($_POST);
		$arr['productionId'] = $id;
		$arr['title'] = $this->input->post('title');
		$arr['total'] = $this->input->post('total');
		$this->admin->saveMarketingFee($arr);
	}

	function editMarketingFee($id)
	{
		$this->data['data'] = $this->admin->getMarketingFeeById($id);
		$this->popupView('/editMarketingFee');
	}

	function updateMarketingFee($id)
	{
		$arr['title'] = $this->input->post('title');
		$arr['total'] = $this->input->post('total');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateMarketingFee($arr, $id);
	}

	function deleteMarketingFee($id)
	{
		$this->admin->deleteMarketingFee($id);
	}

	// Rentals And Misc Fee
	function addRentalAndMisc($id)
	{
		$this->data['id'] = $id;
		$this->popupView('/addRentalAndMisc');
	}

	function saveRentalAndMisc($id)
	{
//		return dnd($_POST);
		$arr['productionId'] = $id;
		$arr['title'] = $this->input->post('title');
		$arr['total'] = $this->input->post('total');
		$this->admin->saveRentalAndMisc($arr);
	}

	function editRentalAndMisc($id)
	{
		$this->data['data'] = $this->admin->getRentalAndMiscById($id);
		$this->popupView('/editRentalAndMisc');
	}

	function updateRentalAndMisc($id)
	{
		$arr['title'] = $this->input->post('title');
		$arr['total'] = $this->input->post('total');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateRentalAndMisc($arr, $id);
	}

	function deleteRentalAndMisc($id)
	{
		$this->admin->deleteRentalAndMisc($id);
	}

	function productions()
	{
		$this->data['title'] = "Production List";
		$this->data['totalCustomerStatus'] = $this->admin->getTotalCustomerStatus();
		$this->makeView('/productions');
	}

	function getProduction()
	{
		$action = '<div class="dropdown">
			<button class="btn btn-sm dropdown-toggle" style="color: white; background-color: black" type="button" data-toggle="dropdown">Actions
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
			  <li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/copyProduction/$1') . '\')">Copy</a></li>
			  <li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/viewProduction/$1') . '\')">View</a></li>
			  <li><a href="' . base_url('admin/editProduction/$1') . '">Edit</a></li>
			<li><a href="' . base_url('admin/deleteProduction/$1') . '" onclick="return confirm(\'Are you sure?\')">Delete</a></li>
			</ul>
		  </div>';
		$this->datatables->select('p.id as id, p.id, p.title, p.customerStatus, p.eventMonth, p.eventYear, v.venueName, v.address, v.city, v.state, v.zip, p.totalVenueCapacity, 
			p.totalProductionCost, p.finalTotalTicketFee, p.overallProductionCost, p.baseTicketPrice, p.ticketMarkup, p.newTicketPrice, 
			p.projectedROI, p.createAt, p.updateAt, p.completedStatus, u.name, u.deleted, p.addedBy');
		$this->datatables->from(TABLE_PRODUCTIONS . ' as p');
		$this->datatables->join(TABLE_USERS . ' as u', 'p.addedBy = u.id');
		$this->datatables->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->datatables->where(array('p.status' => 1));
		$this->datatables->order_by('id', 'desc');
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}

	function deleteProduction($id)
	{
		$this->admin->deleteProduction($id);
		$this->admin->deleteCrewMemberByProductionId($id);
		$this->admin->deleteEntertainerByProductionId($id);
		$this->admin->deleteMarketingFeeByProductionId($id);
		$this->admin->deleteRentalAndMiscByProductionId($id);
		$this->admin->deleteTheatreCrewByProductionId($id);
		$this->session->set_flashdata('success', 'Production Removed Successfully.');
		redirect('admin/productions');
	}

	function viewProduction($id)
	{
		$this->data['data'] = $this->admin->getProductionById($id);
		$this->data['crewData'] = $this->admin->getCrewMemberByProductionId($id);
		$this->data['entertainerData'] = $this->admin->getEntertainerByProductionId($id);
		$this->data['theatreCrewData'] = $this->admin->getTheatreCrewByProductionId($id);
		$this->data['marketingFeeData'] = $this->admin->getMarketingFeeByProductionId($id);
		$this->data['rentalAndMiscData'] = $this->admin->getRentalAndMiscByProductionId($id);
		$this->popupView('/viewProduction');
	}

	function viewProductRejectedReason($id)
	{
		$this->data['data'] = $this->admin->getProductionById($id);
		$this->popupView('/viewProductRejectedReason');
	}

	function updateProductRejectedReason($id)
	{
		$ar['rejectedReason'] = $this->input->post('rejectedReason');
		$arr['customerStatus'] = 0;
		$arr['adminStatus'] = 1;
		$ar['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->update($ar, $id);
		$this->session->set_flashdata('success', 'Rejected Reason Update Successfully.');
		redirect('admin/productions');
	}

	function editProduction($id)
	{
		$this->data['title'] = 'Edit Production';
		$this->data['data'] = $this->admin->getProductionById($id);
		$this->data['crewData'] = $this->admin->getCrewMemberByProductionId($id);
		$this->data['entertainerData'] = $this->admin->getEntertainerByProductionId($id);
		$this->data['theatreCrewData'] = $this->admin->getTheatreCrewByProductionId($id);
		$this->data['marketingFeeData'] = $this->admin->getMarketingFeeByProductionId($id);
		$this->data['rentalAndMiscData'] = $this->admin->getRentalAndMiscByProductionId($id);
		$this->makeView('/editProduction');
	}

	function update($id)
	{
		$arr['title'] = $this->input->post('title');
		$arr['eventMonth'] = $this->input->post('eventMonth');
		$arr['eventYear'] = $this->input->post('eventYear');
		$arr['venueId'] = $this->input->post('venueId');
		$arr['rentalFee'] = $this->input->post('rentalFee');
		$arr['backLine'] = $this->input->post('backLine');
		$arr['totalRentalFee'] = $this->input->post('totalRentalFee');
		$arr['ticketFee'] = $this->input->post('ticketFee');
		$arr['serviceFee'] = $this->input->post('serviceFee');
		$arr['totalTicketFee'] = $this->input->post('totalTicketFee');
		$arr['productionFee'] = $this->input->post('productionFee');
		$arr['originationFee'] = $this->input->post('originationFee');
		$arr['coi'] = $this->input->post('coi');
		$arr['totalProductionFee'] = $this->input->post('totalProductionFee');
		$arr['standing'] = $this->input->post('standing');
		$arr['orchesta'] = $this->input->post('orchesta');
		$arr['mezzanine'] = $this->input->post('mezzanine');
		$arr['balcony'] = $this->input->post('balcony');
		$arr['totalVenueCapacity'] = $this->input->post('totalVenueCapacity');
		$arr['totalCrewCost'] = $this->input->post('totalCrewCost');
		$arr['totalEntertainerCost'] = $this->input->post('totalEntertainerCost');
		$arr['totalTheatreCrewCost'] = $this->input->post('totalTheatreCrewCost');
		$arr['graphicDesign'] = $this->input->post('graphicDesign');
		$arr['radio'] = $this->input->post('radio');
		$arr['television'] = $this->input->post('television');
		$arr['billboard'] = $this->input->post('billboard');
		$arr['facebook'] = $this->input->post('facebook');
		$arr['instagram'] = $this->input->post('instagram');
		$arr['twitter'] = $this->input->post('twitter');
		$arr['tikTok'] = $this->input->post('tikTok');
		$arr['printing'] = $this->input->post('printing');
		$arr['trailerPromo'] = $this->input->post('trailerPromo');
		$arr['other'] = $this->input->post('other');
		$arr['totalAdvertising'] = $this->input->post('totalAdvertising');
		$arr['totalMarketingFees'] = $this->input->post('totalMarketingFees');
		$arr['totalRentalAndMiscFees'] = $this->input->post('totalRentalAndMiscFees');
		$arr['totalProductionCost'] = $this->input->post('totalProductionCost');
		$arr['finalTotalTicketFee'] = $this->input->post('finalTotalTicketFee');
		$arr['overallProductionCost'] = $this->input->post('overallProductionCost');
		$arr['baseTicketPrice'] = $this->input->post('baseTicketPrice');
		$arr['ticketMarkup'] = $this->input->post('ticketMarkup');
		$arr['newTicketPrice'] = $this->input->post('newTicketPrice');
		$arr['projectedROI'] = $this->input->post('projectedROI');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$arr['customerStatus'] = 0;
		$arr['adminStatus'] = 1;
		$this->admin->update($arr, $id);
		$this->session->set_flashdata('success', 'Production Update Successfully.');
		redirect('admin/productions');
	}

	function updateStatus()
	{
		$id = $this->input->post('id');
		$arr['completedStatus'] = $this->input->post('completedStatus');
		$arr['rejectedReason'] = '';
		$arr['customerStatus'] = 0;
		$arr['adminStatus'] = 1;
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->update($arr, $id);
		echo json_encode(array('status' => 'success'));
	}

	function updateAssigned()
	{
		$id = $this->input->post('id');
		$arr['addedBy'] = $this->input->post('addedBy');
		$arr['customerStatus'] = 0;
		$arr['adminStatus'] = 1;
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->update($arr, $id);
		$ar['runningProductionId'] = getSession()->runningProductionId = 0;
		$this->admin->updateCustomer($ar, getSession()->id);
		echo json_encode(array('status' => 'success'));
	}

	function copyProduction($id)
	{
		$this->data['title'] = 'Copy Production';
		$this->data['data'] = $this->admin->getProductionById($id);
		$this->popupView('/copyProduction');
	}

	function saveCopyProduction($id)
	{
		$arr['title'] = $this->input->post('title');
		$arr['eventMonth'] = $this->input->post('eventMonth');
		$arr['eventYear'] = $this->input->post('eventYear');
		$arr['venueId'] = $this->input->post('venueId');
		$arr['addedBy'] = $this->input->post('addedBy');
		$data = $this->admin->getProductionById($id);
		$arr['rentalFee'] = $data->rentalFee;
		$arr['backLine'] = $data->backLine;
		$arr['totalRentalFee'] = $data->totalRentalFee;
		$arr['ticketFee'] = $data->ticketFee;
		$arr['serviceFee'] = $data->serviceFee;
		$arr['totalTicketFee'] = $data->totalTicketFee;
		$arr['productionFee'] = $data->productionFee;
		$arr['originationFee'] = $data->originationFee;
		$arr['coi'] = $data->coi;
		$arr['totalProductionFee'] = $data->totalProductionFee;
		$arr['standing'] = $data->standing;
		$arr['orchesta'] = $data->orchesta;
		$arr['mezzanine'] = $data->mezzanine;
		$arr['balcony'] = $data->balcony;
		$arr['totalVenueCapacity'] = $data->totalVenueCapacity;
		$arr['totalCrewCost'] = $data->totalCrewCost;
		$arr['totalEntertainerCost'] = $data->totalEntertainerCost;
		$arr['totalTheatreCrewCost'] = $data->totalTheatreCrewCost;
		$arr['graphicDesign'] = $data->graphicDesign;
		$arr['radio'] = $data->radio;
		$arr['television'] = $data->television;
		$arr['billboard'] = $data->billboard;
		$arr['facebook'] = $data->facebook;
		$arr['instagram'] = $data->instagram;
		$arr['twitter'] = $data->twitter;
		$arr['tikTok'] = $data->tikTok;
		$arr['printing'] = $data->printing;
		$arr['trailerPromo'] = $data->trailerPromo;
		$arr['other'] = $data->other;
		$arr['totalAdvertising'] = $data->totalAdvertising;
		$arr['totalMarketingFees'] = $data->totalMarketingFees;
		$arr['totalRentalAndMiscFees'] = $data->totalRentalAndMiscFees;
		$arr['totalProductionCost'] = $data->totalProductionCost;
		$arr['finalTotalTicketFee'] = $data->finalTotalTicketFee;
		$arr['overallProductionCost'] = $data->overallProductionCost;
		$arr['baseTicketPrice'] = $data->baseTicketPrice;
		$arr['ticketMarkup'] = $data->ticketMarkup;
		$arr['newTicketPrice'] = $data->newTicketPrice;
		$arr['projectedROI'] = $data->projectedROI;
		$arr['customerStatus'] = 0;
		$arr['adminStatus'] = 1;
		$this->admin->save($arr);
		$productionId = $this->db->insert_id();
		$crewData = $this->admin->getCrewMemberByProductionId($id);
		if ($crewData) {
			foreach ($crewData as $crewDatum) {
				$crew['productionId'] = $productionId;
				$crew['firstName'] = $crewDatum->firstName;
				$crew['lastName'] = $crewDatum->lastName;
				$crew['role'] = $crewDatum->role;
				$crew['rate'] = $crewDatum->rate;
				$crew['hotelName'] = $crewDatum->hotelName;
				$crew['hotelNightlyRate'] = $crewDatum->hotelNightlyRate;
				$crew['totalNight'] = $crewDatum->totalNight;
				$crew['perDiem'] = $crewDatum->perDiem;
				$crew['airline'] = $crewDatum->airline;
				$crew['airlineFrom'] = $crewDatum->airlineFrom;
				$crew['airlineTo'] = $crewDatum->airlineTo;
				$crew['airlineTicketType'] = $crewDatum->airlineTicketType;
				$crew['rountTrip'] = $crewDatum->rountTrip;
				$crew['ticketCost'] = $crewDatum->ticketCost;
				$crew['groundTransCo'] = $crewDatum->groundTransCo;
				$crew['groundTransCost'] = $crewDatum->groundTransCost;
				$crew['miscFee'] = $crewDatum->miscFee;
				$crew['equipmentRental'] = $crewDatum->equipmentRental;
				$crew['crewNotes'] = $crewDatum->crewNotes;
				$crew['crewCost'] = $crewDatum->crewCost;
				$this->admin->saveCrewMember($crew);
			}
		}
		$entertainerData = $this->admin->getEntertainerByProductionId($id);
		if ($entertainerData) {
			foreach ($entertainerData as $entertainerDatum) {
				$entertainer['productionId'] = $productionId;
				$entertainer['firstName'] = $entertainerDatum->firstName;
				$entertainer['lastName'] = $entertainerDatum->lastName;
				$entertainer['role'] = $entertainerDatum->role;
				$entertainer['bookingFee'] = $entertainerDatum->bookingFee;
				$entertainer['hotelName'] = $entertainerDatum->hotelName;
				$entertainer['hotelNightlyRate'] = $entertainerDatum->hotelNightlyRate;
				$entertainer['totalNight'] = $entertainerDatum->totalNight;
				$entertainer['perDiem'] = $entertainerDatum->perDiem;
				$entertainer['airline'] = $entertainerDatum->airline;
				$entertainer['airlineFrom'] = $entertainerDatum->airlineFrom;
				$entertainer['airlineTo'] = $entertainerDatum->airlineTo;
				$entertainer['airlineTicketType'] = $entertainerDatum->airlineTicketType;
				$entertainer['rountTrip'] = $entertainerDatum->rountTrip;
				$entertainer['ticketCost'] = $entertainerDatum->ticketCost;
				$entertainer['groundTransCo'] = $entertainerDatum->groundTransCo;
				$entertainer['groundTransCost'] = $entertainerDatum->groundTransCost;
				$entertainer['miscFee'] = $entertainerDatum->miscFee;
				$entertainer['riderFee'] = $entertainerDatum->riderFee;
				$entertainer['entertainerNotes'] = $entertainerDatum->entertainerNotes;
				$entertainer['entertainerCost'] = $entertainerDatum->entertainerCost;
				$this->admin->saveEntertainer($entertainer);
			}
		}
		$theatreCrewData = $this->admin->getTheatreCrewByProductionId($id);
		if ($theatreCrewData) {
			foreach ($theatreCrewData as $theatreCrewDatum) {
				$theatreCrew['productionId'] = $productionId;
				$theatreCrew['memberTitle'] = $theatreCrewDatum->memberTitle;
				$theatreCrew['hourlyRate'] = $theatreCrewDatum->hourlyRate;
				$theatreCrew['laborHour'] = $theatreCrewDatum->laborHour;
				$theatreCrew['total'] = $theatreCrewDatum->total;
				$this->admin->saveTheatreCrew($theatreCrew);
			}
		}
		$marketingFeeData = $this->admin->getMarketingFeeByProductionId($id);
		if ($marketingFeeData) {
			foreach ($marketingFeeData as $marketingFeeDatum) {
				$marketingFee['productionId'] = $productionId;
				$marketingFee['title'] = $marketingFeeDatum->title;
				$marketingFee['total'] = $marketingFeeDatum->total;
				$this->admin->saveMarketingFee($marketingFee);
			}
		}
		$rentalAndMiscData = $this->admin->getRentalAndMiscByProductionId($id);
		if ($rentalAndMiscData) {
			foreach ($rentalAndMiscData as $rentalAndMiscDatum) {
				$rentalAndMisc['productionId'] = $productionId;
				$rentalAndMisc['title'] = $rentalAndMiscDatum->title;
				$rentalAndMisc['total'] = $rentalAndMiscDatum->total;
				$this->admin->saveRentalAndMisc($rentalAndMisc);
			}
		}
		$this->session->set_flashdata('success', 'Production Copied Successfully.');
		redirect('admin/productions');
	}

	function vendorInvoice()
	{
		$this->data['title'] = 'Vendor Invoice';
		$this->data['totalVendorStatus'] = $this->admin->getTotalVendorStatus();
		$this->makeView('/vendorInvoice');
	}

	function getVendorInvoice()
	{
		$action = '<div class="dropdown">
			<button class="btn btn-sm dropdown-toggle" style="color: white; background-color: black" type="button" data-toggle="dropdown">Actions
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
			  <li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/viewVendorInvoice/$1') . '\')">View</a></li>
			  <li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/editVendorInvoice/$1') . '\')">Edit</a></li>
			<li><a href="' . base_url('admin/deleteVendorInvoice/$1') . '" onclick="return confirm(\'Are you sure?\')">Delete</a></li>
			</ul>
		  </div>';
		$this->datatables->select('v.id as id, v.id, v.vendorStatus, p.title, u.name, u.phone, u.username, v.invoiceNumber, v.submissionDate, v.dueDate, v.net, v.invoiceAmount, v.msa, v.status, v.createAt, v.updateAt');
		$this->datatables->from(TABLE_VENDORINVOICE . ' as v');
		$this->datatables->join(TABLE_USERS . ' as u', 'v.vendorId = u.id');
		$this->datatables->join(TABLE_PRODUCTIONS . ' as p', 'v.productionId = p.id');
		$this->datatables->join(TABLE_VENUE . ' as vv', 'p.venueId = vv.id');
		$this->datatables->order_by('id', 'desc');
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}

	function vendorInvoiceMarkRead($id)
	{
		$arr['vendorStatus'] = 0;
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateVendorInvoice($arr, $id);
		$this->session->set_flashdata('success', 'Vendor Invoice Marked as Read Successfully.');
		redirect('admin/vendorInvoice');
	}

	function addVendorInvoice()
	{
		$this->popupView('/addVendorInvoice');
	}

	function getVendorSearch()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response = $this->admin->getVendorSearch($searchTerm);
		echo json_encode($response);
	}

	function getProductionSearch()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response = $this->admin->getProductionSearch($searchTerm);
		echo json_encode($response);
	}


	function saveVendorInvoice()
	{
//		return dnp($_FILES);
		$id = 1;
		if ($this->admin->getLastVendorInvoiceIdByToday()) {
			$id = $this->admin->getLastVendorInvoiceIdByToday()->id + 1;
		}
		$vendorId = $arr['vendorId'] = $this->input->post('vendorId');
		$productionId = $arr['productionId'] = $this->input->post('productionId');
		$arr['invoiceNumber'] = date('Ymd') . '-' . str_pad($id, 4, '0', STR_PAD_LEFT);
		$arr['submissionDate'] = date('Y-m-d', strtotime($this->input->post('date')));
		$arr['dueDate'] = date('Y-m-d', strtotime($this->input->post('dueDate')));
		$arr['net'] = $this->input->post('net');
		$arr['invoiceAmount'] = $this->input->post('invoiceAmount');
		$arr['vendorNotes'] = $this->input->post('vendorNotes');
		$arr['status'] = 'Unpaid';
		$arr['adminCustomerStatus'] = 1;
		$arr['vendorStatus'] = 0;
		$config['upload_path'] = './images/' . $vendorId . '/' . $productionId;
		$config['allowed_types'] = 'pdf';
		$config['overwrite'] = true;

		if (!is_dir('images')) {
			mkdir('./images', 0777, true);
		}
		if (!is_dir('images/' . $vendorId)) {
			mkdir('./images/' . $vendorId, 0777, true);
		}
		if (!is_dir('images/' . $vendorId . '/' . $productionId)) {
			mkdir('./images/' . $vendorId . '/' . $productionId, 0777, true);
		}
		$this->load->library('upload', $config);
		if (!empty($_FILES['msa']['name'])) {
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('msa')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('danger', $error);
				redirect('admin/vendorInvoice');
			}

			$file = $this->upload->data('file_name');
			$arr['msa'] = $file;
		}
		$this->admin->saveVendorInvoice($arr);
		$invoiceId = $this->db->insert_id();
		for ($i = 0; $i < count($this->input->post('description')); $i++) {
			$ar['vendorInvoiceId'] = $invoiceId;
			$ar['description'] = $this->input->post('description')[$i];
			$ar['qty'] = $this->input->post('qty')[$i];
			$ar['price'] = $this->input->post('price')[$i];
			$ar['total'] = $this->input->post('total')[$i];
			$this->admin->saveVendorInvoiceDetails($ar);
		}
		$this->session->set_flashdata('success', 'Vendor Invoice Added Successfully.');
		redirect('admin/vendorInvoice');
	}

	function viewVendorInvoice($id)
	{
		$this->data['data'] = $this->admin->getVendorInvoiceById($id);
		$this->data['details'] = $this->admin->getVendordetailsInvoiceById($id);
		$this->popupView('/viewVendorInvoice');
	}

	function viewVendorInvoiceMSA($id)
	{
		$this->data['data'] = $this->admin->getVendorInvoiceById($id);
		$this->popupView('/viewVendorInvoiceMSA');
	}

	function viewVendorInvoiceW9Form($id)
	{
		$this->data['data'] = $this->admin->getCustomerById($id);
		$this->popupView('/viewVendorInvoiceW9Form');
	}

	function viewRejectedReason($id)
	{
		$this->data['data'] = $this->admin->getVendorInvoiceById($id);
		$this->popupView('/viewRejectedReason');
	}

	function updateRejectedReason($id)
	{
		$ar['rejectedReason'] = $this->input->post('rejectedReason');
		$ar['updateAt'] = date('Y-m-d H:i:s');
		$arr['adminCustomerStatus'] = 1;
		$arr['vendorStatus'] = 0;
		$this->admin->updateVendorInvoice($ar, $id);
		$this->session->set_flashdata('success', 'Rejected Reason Update Successfully.');
		redirect('admin/vendorInvoice');
	}

	function updateVendorInvoiceStatus()
	{
		$id = $this->input->post('id');
		$arr['status'] = $this->input->post('status');
		$arr['rejectedReason'] = '';
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$arr['adminCustomerStatus'] = 1;
		$arr['vendorStatus'] = 0;
		$this->admin->updateVendorInvoice($arr, $id);
		echo json_encode(array('status' => 'success'));
	}


	function updateVendorInvoice($id)
	{
		$vendorId = $arr['vendorId'] = $this->input->post('vendorId');
		$productionId = $arr['productionId'] = $this->input->post('productionId');
		$arr['submissionDate'] = date('Y-m-d', strtotime($this->input->post('date')));
		$arr['dueDate'] = date('Y-m-d', strtotime($this->input->post('dueDate')));
		$arr['net'] = $this->input->post('net');
		$arr['invoiceAmount'] = $this->input->post('invoiceAmount');
		$arr['vendorNotes'] = $this->input->post('vendorNotes');
		$arr['status'] = 'Unpaid';
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$arr['adminCustomerStatus'] = 1;
		$arr['vendorStatus'] = 0;
		$config['upload_path'] = './images/' . $vendorId . '/' . $productionId;
		$config['allowed_types'] = 'pdf';
		$config['overwrite'] = true;

		if (!is_dir('images')) {
			mkdir('./images', 0777, true);
		}
		if (!is_dir('images/' . $vendorId)) {
			mkdir('./images/' . $vendorId, 0777, true);
		}
		if (!is_dir('images/' . $vendorId . '/' . $productionId)) {
			mkdir('./images/' . $vendorId . '/' . $productionId, 0777, true);
		}
		$this->load->library('upload', $config);
		if (!empty($_FILES['msa']['name'])) {
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('msa')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('danger', $error);
				redirect('admin/vendorInvoice');
			}

			$file = $this->upload->data('file_name');
			$arr['msa'] = $file;
		}
		$this->admin->updateVendorInvoice($arr, $id);
		$this->admin->deleteVendorInvoiceDetailsByInvoiceId($id);
		for ($i = 0; $i < count($this->input->post('description')); $i++) {
			$ar['vendorInvoiceId'] = $id;
			$ar['description'] = $this->input->post('description')[$i];
			$ar['qty'] = $this->input->post('qty')[$i];
			$ar['price'] = $this->input->post('price')[$i];
			$ar['total'] = $this->input->post('total')[$i];
			$this->admin->saveVendorInvoiceDetails($ar);
		}
		$this->session->set_flashdata('success', 'Vendor Invoice Update Successfully.');
		redirect('admin/vendorInvoice');
	}

	function editVendorInvoice($id)
	{
		$this->data['data'] = $this->admin->getVendorInvoiceById($id);
		$this->data['details'] = $this->admin->getVendordetailsInvoiceById($id);
		$this->popupView('/editVendorInvoice');
	}

	function deleteVendorInvoice($id)
	{
		$this->admin->deleteVendorInvoiceById($id);
		$this->admin->deleteVendorInvoiceDetailsByInvoiceId($id);
		$this->session->set_flashdata('success', 'Vendor Invoice Removed Successfully.');
		redirect('admin/vendorInvoice');
	}

	// venue

	function venues()
	{
		$this->data['title'] = 'House of Venues';
		$this->makeView('/venues');
	}

	function saveVenue()
	{
//		return dnp(count($_FILES['attachment']['name']));
		$arr['venueName'] = $this->input->post('venueName');
		$arr['venueWebsite'] = $this->input->post('venueWebsite');
		$arr['address'] = $this->input->post('address');
		$arr['city'] = $this->input->post('city');
		$arr['state'] = $this->input->post('state');
		$arr['zip'] = $this->input->post('zip');
		$arr['rentalFee'] = $this->input->post('rentalFee');
		$arr['standing'] = $this->input->post('standing');
		$arr['orchesta'] = $this->input->post('orchesta');
		$arr['mezzanine'] = $this->input->post('mezzanine');
		$arr['balcony'] = $this->input->post('balcony');
		$arr['totalVenueCapacity'] = $this->input->post('totalVenueCapacity');
		$arr['createBy'] = getSession()->id;
		$this->admin->saveVenue($arr);
		$venueId = $this->db->insert_id();
		for ($i = 0; $i < count($this->input->post('pocName')); $i++) {
			$ar['venueId'] = $venueId;
			$ar['pocName'] = $this->input->post('pocName')[$i];
			$ar['pocTitle'] = $this->input->post('pocTitle')[$i];
			$ar['pocPhone'] = $this->input->post('pocPhone')[$i];
			$ar['pocEmail'] = $this->input->post('pocEmail')[$i];
			$this->admin->saveVenuePoc($ar);
		}
		for ($i = 0; $i < count($_FILES['attachment']['name']); $i++) {
			$a['attachmentName'] = $this->input->post('attachmentName')[$i];
			$a['venueId'] = $venueId;

			$upload_path = './images/venues/' . $venueId;
			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|jfif';
			$config['overwrite'] = true;
			$config['mime_check'] = false;

			if (!is_dir('./images')) {
				mkdir('./images', 0777, true);
			}
			if (!is_dir('./images/venues')) {
				mkdir('./images/venues', 0777, true);
			}
			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0777, true);
			}

			$this->load->library('upload');

			if (!empty($_FILES['attachment']['name'][$i])) {
				$_FILES['file']['name'] = $_FILES['attachment']['name'][$i];
				$_FILES['file']['type'] = $_FILES['attachment']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['attachment']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['attachment']['error'][$i];
				$_FILES['file']['size'] = $_FILES['attachment']['size'][$i];

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('file')) {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('danger', $error);
					redirect('admin/venues');
					return;
				} else {
					$upload_data = $this->upload->data();
					$file_name = $upload_data['file_name'];
					$a['attachment'] = $file_name;
				}
				$this->admin->saveVenueAttachment($a);
			}
		}
		$this->session->set_flashdata('success', 'Venue Added Successfully.');
		redirect('admin/venues');
	}

	function getVenues()
	{
		$action = '<div class="dropdown">
		<button class="btn btn-sm dropdown-toggle" style="color: white; background-color: black" type="button" data-toggle="dropdown">Actions
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/viewVenue/$1') . '\')">View</a></li>
			<li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/editVenue/$1') . '\')">Edit</a></li>
			<li><a href="' . base_url('admin/deleteVenue/$1') . '" onclick="return confirm(\'Are you sure?\')">Delete</a></li>
		</ul>
	  </div>';

		$this->datatables->select('v.id as id, v.id, v.venueName, u.name, v.venueWebsite, v.address, v.city, v.state, v.zip, v.rentalFee, 
		v.totalVenueCapacity, v.createAt, v.updateAt, p.pocName, p.pocTitle, p.pocPhone, p.pocEmail');
		$this->datatables->from(TABLE_VENUE . ' as v');

		// Subquery to get the first id (minimum id) for each venueId
		$subquery = '(SELECT MIN(id) as min_id, venueId FROM ' . TABLE_VENUEPOC . ' GROUP BY venueId) as first_poc';

		$this->datatables->join($subquery, 'first_poc.venueId = v.id', 'left');
		$this->datatables->join(TABLE_VENUEPOC . ' as p', 'p.id = first_poc.min_id', 'left');
		$this->datatables->join(TABLE_USERS . ' as u', 'v.createBy = u.id');
		$this->datatables->order_by('v.id', 'desc');
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}


	function editVenue($id)
	{
		$this->data['data'] = $this->admin->getVenueById($id);
		$this->data['pocs'] = $this->admin->getVenuePocById($id);
		$this->data['attachments'] = $this->admin->getVenueAttachmentById($id);
		$this->popupView('/editVenue');
	}

	function updateVenue($id)
	{
//		return dnp($_FILES['attachment']['name']);
//		return dnp($_POST);
		$arr['venueName'] = $this->input->post('venueName');
		$arr['venueWebsite'] = $this->input->post('venueWebsite');
		$arr['address'] = $this->input->post('address');
		$arr['city'] = $this->input->post('city');
		$arr['state'] = $this->input->post('state');
		$arr['zip'] = $this->input->post('zip');
		$arr['rentalFee'] = $this->input->post('rentalFee');
		$arr['standing'] = $this->input->post('standing');
		$arr['orchesta'] = $this->input->post('orchesta');
		$arr['mezzanine'] = $this->input->post('mezzanine');
		$arr['balcony'] = $this->input->post('balcony');
		$arr['totalVenueCapacity'] = $this->input->post('totalVenueCapacity');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateVenue($arr, $id);
		$this->admin->deleteVenuePoc($id);
		for ($i = 0; $i < count($this->input->post('pocName')); $i++) {
			$ar['venueId'] = $id;
			$ar['pocName'] = $this->input->post('pocName')[$i];
			$ar['pocTitle'] = $this->input->post('pocTitle')[$i];
			$ar['pocPhone'] = $this->input->post('pocPhone')[$i];
			$ar['pocEmail'] = $this->input->post('pocEmail')[$i];
			$this->admin->saveVenuePoc($ar);
		}
		if ($this->input->post('attachmentId')) {
			for ($i = 0; $i < count($this->input->post('attachmentId')); $i++) {
				$attachmentId = $this->input->post('attachmentId')[$i];
				$attachmentName['attachmentName'] = $this->input->post('attachmentName')[$i];
				$this->admin->updateVenueAttachment($attachmentName, $attachmentId);
			}
		}
		for ($i = 0; $i < count($_FILES['attachment']['name']); $i++) {
			$a['attachmentName'] = $this->input->post('attachmentName')[$i];
			$a['venueId'] = $id;
			$upload_path = './images/venues/' . $id;
			$config['upload_path'] = $upload_path;
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|jfif';
			$config['overwrite'] = true;
			$config['mime_check'] = false;

			if (!is_dir('./images')) {
				mkdir('./images', 0777, true);
			}
			if (!is_dir('./images/venues')) {
				mkdir('./images/venues', 0777, true);
			}
			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0777, true);
			}

			$this->load->library('upload');

			if (!empty($_FILES['attachment']['name'][$i])) {
				$_FILES['file']['name'] = $_FILES['attachment']['name'][$i];
				$_FILES['file']['type'] = $_FILES['attachment']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['attachment']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['attachment']['error'][$i];
				$_FILES['file']['size'] = $_FILES['attachment']['size'][$i];

				$this->upload->initialize($config);

				if (!$this->upload->do_upload('file')) {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('danger', $error);
					redirect('admin/venues');
					return;
				} else {
					$upload_data = $this->upload->data();
					$file_name = $upload_data['file_name'];
					$a['attachment'] = $file_name;
				}
				$this->admin->deleteVenueAttachment($id);
				$this->admin->saveVenueAttachment($a);
			}

		}
		$this->session->set_flashdata('success', 'Venue Added Successfully.');
		redirect('admin/venues');
	}

	function viewVenue($id)
	{
		$this->data['data'] = $this->admin->getVenueById($id);
		$this->data['pocs'] = $this->admin->getVenuePocById($id);
		$this->data['attachments'] = $this->admin->getVenueAttachmentById($id);
		$this->popupView('/viewVenue');
	}

	function viewVenuePdf($id)
	{
		$this->data['data'] = $this->admin->getVenueAttachmentPdfById($id);
		$this->popupView('/viewVenuePdf');
	}

	function deleteVenue($id)
	{
		$this->admin->deleteVenue($id);
		$this->admin->deleteVenuePoc($id);
		$this->admin->deleteVenueAttachment($id);
		$this->session->set_flashdata('success', 'Venue Remove Successfully.');
		redirect('admin/venues');
	}
}
