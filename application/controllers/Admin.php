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

	function getVenueSearch()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response = $this->admin->getVenueSearch($searchTerm);
		echo json_encode($response);
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

	// crew member

	function productionMarkRead($id)
	{
		$arr['customerStatus'] = 0;
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->update($arr, $id);
		$this->session->set_flashdata('success', 'Production Marked as Read Successfully.');
		redirect('admin/productions');
	}

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

	// theatre Crew

	function deleteCrewMember($id)
	{
		$this->admin->deleteCrewMember($id);
	}

	function addTheatreCrew($id)
	{
		$this->data['id'] = $id;
		$this->popupView('/addTheatreCrew');
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

	function addMarketingFee($id)
	{
		$this->data['id'] = $id;
		$this->popupView('/addMarketingFee');
	}

	// Marketing Fee

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

	function addRentalAndMisc($id)
	{
		$this->data['id'] = $id;
		$this->popupView('/addRentalAndMisc');
	}

	function editRentalAndMisc($id)
	{
		$this->data['data'] = $this->admin->getRentalAndMiscById($id);
		$this->popupView('/editRentalAndMisc');
	}

	// Rentals And Misc Fee

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

	function saveMarketingFee($id)
	{
//		return dnd($_POST);
		$arr['productionId'] = $id;
		$arr['title'] = $this->input->post('title');
		$arr['total'] = $this->input->post('total');
		$this->admin->saveMarketingFee($arr);
	}

	function saveRentalAndMisc($id)
	{
//		return dnd($_POST);
		$arr['productionId'] = $id;
		$arr['title'] = $this->input->post('title');
		$arr['total'] = $this->input->post('total');
		$this->admin->saveRentalAndMisc($arr);
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

	// run of show
	function runOfShow()
	{
		$this->data['title'] = 'Run of Show';
		$this->makeView('/runOfShow');
	}

	function addRunShow()
	{
		$this->popupView('/addRunShow');
	}

	function getRunOfShow()
	{
		$action = '<div class="dropdown">
		<button class="btn btn-sm dropdown-toggle" style="color: white; background-color: black" type="button" data-toggle="dropdown">Actions
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/copyRunShow/$1') . '\')">Copy</a></li>
			<li><a href="viewRunOfShowSchedule/$1">View</a></li>
			<li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/editRunShow/$1') . '\')">Edit</a></li>
			<li><a href="' . base_url('admin/changeRunOfShowArchiveStatus/$1') . '" onclick="return confirm(\'Are you sure?\')">Archive</a></li>
			<li><a href="timeAccessLink/$1" onclick="">Timed Access Link</a></li>
			<li><a href="' . base_url('admin/deleteRunOfShow/$1') . '" onclick="return confirm(\'Are you sure?\')">Delete</a></li>
		</ul>
	  </div>';

		$this->datatables->select('r.id as id, p.title, r.description, r.date, r.time, r.updateAt');
		$this->datatables->from(TABLE_RUNOFSHOW . ' as r');
		$this->datatables->join(TABLE_PRODUCTIONS . ' as p', 'r.productionId = p.id');
		$this->datatables->where(array('r.archivesStatus' => 0));
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}

	function copyRunShow($id)
	{
		$this->data['data'] = $this->admin->getRunOfShowById($id);
		$this->popupView('/copyRunShow');
	}

	function saveCopyRunShow($id)
	{
//		dnp($_POST);
		$ar['productionId'] = $this->input->post('productionId');
		$ar['description'] = $this->input->post('description');
		$ar['date'] = date('Y-m-d', strtotime($this->input->post('date')));
		$ar['time'] = $this->input->post('time');
		$this->admin->saveRunOfShow($ar);
		$runOfShowId = $this->db->insert_id();
		$this->admin->duplicateRunOfShowSchedule($id, $runOfShowId);
		$this->admin->duplicateRunOfShowCrewTravel($id, $runOfShowId);
		$this->admin->duplicateRunOfShowTalentCrew($id, $runOfShowId);
		$this->admin->duplicateRunOfShowPoc($id, $runOfShowId);
		$this->session->set_flashdata('success', 'Run of Show Copied Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function changeRunOfShowArchiveStatus($id)
	{
		$arr['archivesStatus'] = 1;
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateRunOfShow($arr, $id);
		$this->session->set_flashdata('success', 'Run of Show Marked Archived Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function saveRunShow()
	{
		$ar['productionId'] = $this->input->post('productionId');
		$ar['description'] = $this->input->post('description');
		$ar['date'] = date('Y-m-d', strtotime($this->input->post('date')));
		$ar['time'] = $this->input->post('time');
		$this->admin->saveRunOfShow($ar);
		$this->session->set_flashdata('success', 'Run of Show Added Successfully.');
		redirect('admin/runOfShow');
	}

	function editRunShow($id)
	{
		$this->data['data'] = $this->admin->getRunOfShowById($id);
		$this->popupView('/editRunShow');
	}

	function updateRunShow($id)
	{
		$ar['productionId'] = $this->input->post('productionId');
		$ar['description'] = $this->input->post('description');
		$ar['date'] = date('Y-m-d', strtotime($this->input->post('date')));
		$ar['time'] = $this->input->post('time');
		$ar['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateRunOfShow($ar, $id);
		$this->session->set_flashdata('success', 'Run of Show Updated Successfully.');
		redirect('admin/runOfShow');
	}

	function deleteRunOfShow($id)
	{
		$this->admin->deleteRunOfShow($id);
		$this->admin->deleteRunOfShowDetailsByRunId($id);
		$this->admin->deleteRunOfShowCrewTravelByRunOfShowId($id);
		$this->admin->deleteRunOfShowTalentCrewRunOfShowId($id);
		$this->admin->deleteRunOfShowPocRunOfShowId($id);
		$this->session->set_flashdata('success', 'Run of Show Deleted Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function viewRunOfShowSchedule($id)
	{
		$this->data['title'] = 'View Run Of Show Schedule';
		$this->data['data'] = $this->admin->getRunOfShowById($id);
		$this->data['runOfShowDetails'] = $this->admin->getRunOfShowScheduleDetails($id);
		$this->makeView('/viewRunOfShowSchedule');
	}

	public function saveRunOfShowScheduleDetails($id)
	{
		// Fetch posted data
//		return dnp($_POST);
		$titles = $this->input->post('title');
		$items = $this->input->post('items');
		$start_times = $this->input->post('start');
		$durations = $this->input->post('duration');
		$leadTeamMember = $this->input->post('leadTeamMember');
		$crewMember = $this->input->post('crewMember');
		$talents = $this->input->post('talent');
		$locations = $this->input->post('location');
		$areas = $this->input->post('area');
		$details = $this->input->post('details');
		$privateNotes = $this->input->post('privateNotes');

//		if (empty($titles)) {
//			// If no titles are posted, set an error message and redirect
//			$this->session->set_flashdata('danger', 'No data submitted or remove all data successfully.');
//			redirect($_SERVER['HTTP_REFERER']);
//			return; // Exit the function to prevent further execution
//		}

		if (empty($items) && !empty($titles)) {
			// If no items are posted, set an error message and redirect
			$this->session->set_flashdata('danger', 'Title must have at least one item!');
			redirect($_SERVER['HTTP_REFERER']);
			return; // Exit the function to prevent further execution
		}

//		return dnp($items);
		// Delete all existing records related to this run_of_show
		$this->admin->deleteRunOfShowDetailsByRunId($id);

		// Re-insert the new data
		if ($titles) {
			foreach ($titles as $titleId => $titleName) {
				// Insert each title
				$titleData = [
					'runOfShowId' => $id,
					'title_name' => $titleName,
				];
				$titleInsertId = $this->admin->insertRunOfShowScheduleTitle($titleData);

				// Insert corresponding items for each title
				if (!empty($items[$titleId])) {
					foreach ($items[$titleId] as $index => $itemName) {
						$itemData = [
							'title_id' => $titleInsertId,
							'runOfShowId' => $id,
							'item_name' => $itemName,
							'start_time' => $start_times[$titleId][$index],
							'duration' => $durations[$titleId][$index],
							'leadTeamMember' => isset($leadTeamMember[$titleId][$index]) ? $leadTeamMember[$titleId][$index] : null,
							'crew_member' => $crewMember[$titleId][$index],
							'talent' => $talents[$titleId][$index],
							'location' => $locations[$titleId][$index],
							'area_space' => $areas[$titleId][$index],
							'details' => $details[$titleId][$index],
							'private_notes' => $privateNotes[$titleId][$index],
						];
						$this->admin->insertRunOfShowScheduleItem($itemData);
					}
				}
			}
		}

		// Set success message and redirect
		$this->session->set_flashdata('success', 'Run of Show Details Updated Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	// archives
	function archives()
	{
		$this->data['title'] = 'Archives';
		$this->makeView('/archives');
	}

	function getArchives()
	{
		$action = '<div class="dropdown">
		<button class="btn btn-sm dropdown-toggle" style="color: white; background-color: black" type="button" data-toggle="dropdown">Actions
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<li><a href="viewRunOfShowSchedule/$1">View</a></li>
			<li><a href="' . base_url('admin/changeRunOfShowUnarchivedStatus/$1') . '" onclick="return confirm(\'Are you sure?\')">Unarchived</a></li>
			<li><a href="' . base_url('admin/deleteRunOfShow/$1') . '" onclick="return confirm(\'Are you sure?\')">Delete</a></li>
		</ul>
	  </div>';

		$this->datatables->select('r.id as id, p.title, r.description, r.date, r.time, r.updateAt');
		$this->datatables->from(TABLE_RUNOFSHOW . ' as r');
		$this->datatables->join(TABLE_PRODUCTIONS . ' as p', 'r.productionId = p.id');
		$this->datatables->where(array('r.archivesStatus' => 1));
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}

	function changeRunOfShowUnarchivedStatus($id)
	{
		$arr['archivesStatus'] = 0;
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateRunOfShow($arr, $id);
		$this->session->set_flashdata('success', 'Run of Show marked Unarchived Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}


	// crew travel
	function viewRunOfShowCrewTravel($id)
	{
		$this->data['title'] = 'View Run Of Show Crew Travel';
		$this->data['data'] = $this->admin->getRunOfShowById($id);
		$this->data['crewTravelDetails'] = $this->admin->getRunOfShowCrewTravelDetails($id);
		$this->makeView('/viewRunOfShowCrewTravel');
	}

	function addRunOfShowCrewTravel($id)
	{
		$this->data['runOfShowDetails'] = $this->admin->getRunOfShowById($id);
		$this->popupView('/addRunOfShowCrewTravel');
	}

	function getCrewMemberSearch($id)
	{
		$searchTerm = $this->input->post('searchTerm');
		$response = $this->admin->getCrewMemberSearch($searchTerm, $id);
		echo json_encode($response);
	}

	function saveRunOfShowCrewTravel($id)
	{
//		return dnd($_POST);
		$arr['runOfShowId'] = $id;
		$arr['crewMemberId'] = $this->input->post('crewMemberId');
		$arr['travelTypeTo'] = $this->input->post('travelTypeTo');
		$arr['airlineTo'] = $this->input->post('airlineTo');
		$arr['specifyTravelTo'] = $this->input->post('specifyTravelTo');
		$arr['airportFromTo'] = $this->input->post('airportFromTo');
		$arr['departureTimeTo'] = $this->input->post('departureTimeTo');
		$arr['confirmationTo'] = $this->input->post('confirmationTo');
		$arr['airportToTo'] = $this->input->post('airportToTo');
		$arr['arrivalTimeTo'] = $this->input->post('arrivalTimeTo');
		$arr['travelTypeFrom'] = $this->input->post('travelTypeFrom');
		$arr['airlineFrom'] = $this->input->post('airlineFrom');
		$arr['specifyTravelFrom'] = $this->input->post('specifyTravelFrom');
		$arr['airportFromFrom'] = $this->input->post('airportFromFrom');
		$arr['departureTimeFrom'] = $this->input->post('departureTimeFrom');
		$arr['confirmationFrom'] = $this->input->post('confirmationFrom');
		$arr['airportToFrom'] = $this->input->post('airportToFrom');
		$arr['arrivalTimeFrom'] = $this->input->post('arrivalTimeFrom');
		$arr['groundTransCo'] = $this->input->post('groundTransCo');
		$arr['vehicleMake'] = $this->input->post('vehicleMake');
		$arr['driverName'] = $this->input->post('driverName');
		$arr['driverPhone'] = $this->input->post('driverPhone');
		$arr['vehicleModel'] = $this->input->post('vehicleModel');
		$arr['vehicleTag'] = $this->input->post('vehicleTag');
		$arr['pickUpTime'] = $this->input->post('pickUpTime');
		$arr['dropOffTime'] = $this->input->post('dropOffTime');
		$arr['dropOffLocation'] = $this->input->post('dropOffLocation');
		$arr['groundNotes'] = $this->input->post('groundNotes');
		$arr['hotelName'] = $this->input->post('hotelName');
		$arr['hotelStay'] = $this->input->post('hotelStay');
		$arr['confirmationAccommodation'] = $this->input->post('confirmationAccommodation');
		$arr['perDiem'] = $this->input->post('perDiem');
		$arr['hotelAddress'] = $this->input->post('hotelAddress');
		$arr['roomType'] = $this->input->post('roomType');
		$arr['checkIn'] = $this->input->post('checkIn');
		$arr['checkOut'] = $this->input->post('checkOut');
		$arr['accommodationNote'] = $this->input->post('accommodationNote');
		$this->admin->saveRunOfShowCrewTravel($arr);
		$this->session->set_flashdata('success', 'Production Crew Travel Details Added Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function editRunOfShowCrewTravel($id)
	{
		$this->data['data'] = $this->admin->getRunOfShowCrewTravelById($id);
		$this->popupView('/editRunOfShowCrewTravel');
	}

	function updateRunOfShowCrewTravel($id)
	{
		$arr['crewMemberId'] = $this->input->post('crewMemberId');
		$arr['travelTypeTo'] = $this->input->post('travelTypeTo');
		$arr['airlineTo'] = $this->input->post('airlineTo');
		$arr['specifyTravelTo'] = $this->input->post('specifyTravelTo');
		$arr['airportFromTo'] = $this->input->post('airportFromTo');
		$arr['departureTimeTo'] = $this->input->post('departureTimeTo');
		$arr['confirmationTo'] = $this->input->post('confirmationTo');
		$arr['airportToTo'] = $this->input->post('airportToTo');
		$arr['arrivalTimeTo'] = $this->input->post('arrivalTimeTo');
		$arr['travelTypeFrom'] = $this->input->post('travelTypeFrom');
		$arr['airlineFrom'] = $this->input->post('airlineFrom');
		$arr['specifyTravelFrom'] = $this->input->post('specifyTravelFrom');
		$arr['airportFromFrom'] = $this->input->post('airportFromFrom');
		$arr['departureTimeFrom'] = $this->input->post('departureTimeFrom');
		$arr['confirmationFrom'] = $this->input->post('confirmationFrom');
		$arr['airportToFrom'] = $this->input->post('airportToFrom');
		$arr['arrivalTimeFrom'] = $this->input->post('arrivalTimeFrom');
		$arr['groundTransCo'] = $this->input->post('groundTransCo');
		$arr['vehicleMake'] = $this->input->post('vehicleMake');
		$arr['driverName'] = $this->input->post('driverName');
		$arr['driverPhone'] = $this->input->post('driverPhone');
		$arr['vehicleModel'] = $this->input->post('vehicleModel');
		$arr['vehicleTag'] = $this->input->post('vehicleTag');
		$arr['pickUpTime'] = $this->input->post('pickUpTime');
		$arr['dropOffTime'] = $this->input->post('dropOffTime');
		$arr['dropOffLocation'] = $this->input->post('dropOffLocation');
		$arr['groundNotes'] = $this->input->post('groundNotes');
		$arr['hotelName'] = $this->input->post('hotelName');
		$arr['hotelStay'] = $this->input->post('hotelStay');
		$arr['confirmationAccommodation'] = $this->input->post('confirmationAccommodation');
		$arr['perDiem'] = $this->input->post('perDiem');
		$arr['hotelAddress'] = $this->input->post('hotelAddress');
		$arr['roomType'] = $this->input->post('roomType');
		$arr['checkIn'] = $this->input->post('checkIn');
		$arr['checkOut'] = $this->input->post('checkOut');
		$arr['accommodationNote'] = $this->input->post('accommodationNote');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateRunOfShowCrewTravel($arr, $id);
		$this->session->set_flashdata('success', 'Production Crew Travel Details Update Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function deleteRunOfShowCrewTravel($id)
	{
		$this->admin->deleteRunOfShowCrewTravel($id);
		$this->session->set_flashdata('success', 'Successfully Removed..');
		redirect($_SERVER['HTTP_REFERER']);
	}

	// Talent Crew
	function viewRunOfShowTalentCrew($id)
	{
		$this->data['title'] = 'View Run Of Show Talent & Crew';
		$this->data['data'] = $this->admin->getRunOfShowById($id);
		$this->data['crewTravelDetails'] = $this->admin->getRunOfShowTalentCrewDetails($id);
		$this->makeView('/viewRunOfShowTalentCrew');
	}

	function addRunOfShowTalentCrew($id)
	{
		$this->data['runOfShowDetails'] = $this->admin->getRunOfShowById($id);
		$this->popupView('/addRunOfShowTalentCrew');
	}

	function getTalentCrewMemberSearch($id)
	{
		$searchTerm = $this->input->post('searchTerm');
		$response = $this->admin->getTalentCrewMemberSearch($searchTerm, $id);
		echo json_encode($response);
	}

	function saveRunOfShowTalentCrew($id)
	{
//		return dnd($_POST);
		$arr['runOfShowId'] = $id;
		$arr['crewMemberId'] = $this->input->post('crewMemberId');
		$arr['travelTypeTo'] = $this->input->post('travelTypeTo');
		$arr['airlineTo'] = $this->input->post('airlineTo');
		$arr['specifyTravelTo'] = $this->input->post('specifyTravelTo');
		$arr['airportFromTo'] = $this->input->post('airportFromTo');
		$arr['departureTimeTo'] = $this->input->post('departureTimeTo');
		$arr['confirmationTo'] = $this->input->post('confirmationTo');
		$arr['airportToTo'] = $this->input->post('airportToTo');
		$arr['arrivalTimeTo'] = $this->input->post('arrivalTimeTo');
		$arr['travelTypeFrom'] = $this->input->post('travelTypeFrom');
		$arr['airlineFrom'] = $this->input->post('airlineFrom');
		$arr['specifyTravelFrom'] = $this->input->post('specifyTravelFrom');
		$arr['airportFromFrom'] = $this->input->post('airportFromFrom');
		$arr['departureTimeFrom'] = $this->input->post('departureTimeFrom');
		$arr['confirmationFrom'] = $this->input->post('confirmationFrom');
		$arr['airportToFrom'] = $this->input->post('airportToFrom');
		$arr['arrivalTimeFrom'] = $this->input->post('arrivalTimeFrom');
		$arr['groundTransCo'] = $this->input->post('groundTransCo');
		$arr['vehicleMake'] = $this->input->post('vehicleMake');
		$arr['driverName'] = $this->input->post('driverName');
		$arr['driverPhone'] = $this->input->post('driverPhone');
		$arr['vehicleModel'] = $this->input->post('vehicleModel');
		$arr['vehicleTag'] = $this->input->post('vehicleTag');
		$arr['pickUpTime'] = $this->input->post('pickUpTime');
		$arr['dropOffTime'] = $this->input->post('dropOffTime');
		$arr['dropOffLocation'] = $this->input->post('dropOffLocation');
		$arr['groundNotes'] = $this->input->post('groundNotes');
		$arr['hotelName'] = $this->input->post('hotelName');
		$arr['hotelStay'] = $this->input->post('hotelStay');
		$arr['confirmationAccommodation'] = $this->input->post('confirmationAccommodation');
		$arr['perDiem'] = $this->input->post('perDiem');
		$arr['hotelAddress'] = $this->input->post('hotelAddress');
		$arr['roomType'] = $this->input->post('roomType');
		$arr['checkIn'] = $this->input->post('checkIn');
		$arr['checkOut'] = $this->input->post('checkOut');
		$arr['accommodationNote'] = $this->input->post('accommodationNote');
		$this->admin->saveRunOfShowTalentCrew($arr);
		$this->session->set_flashdata('success', 'Talent & Crew Travel Details Added Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function editRunOfShowTalentCrew($id)
	{
		$this->data['data'] = $this->admin->getRunOfShowTalentCrewById($id);
		$this->popupView('/editRunOfShowTalentCrew');
	}

	function updateRunOfShowTalentCrew($id)
	{
		$arr['crewMemberId'] = $this->input->post('crewMemberId');
		$arr['travelTypeTo'] = $this->input->post('travelTypeTo');
		$arr['airlineTo'] = $this->input->post('airlineTo');
		$arr['specifyTravelTo'] = $this->input->post('specifyTravelTo');
		$arr['airportFromTo'] = $this->input->post('airportFromTo');
		$arr['departureTimeTo'] = $this->input->post('departureTimeTo');
		$arr['confirmationTo'] = $this->input->post('confirmationTo');
		$arr['airportToTo'] = $this->input->post('airportToTo');
		$arr['arrivalTimeTo'] = $this->input->post('arrivalTimeTo');
		$arr['travelTypeFrom'] = $this->input->post('travelTypeFrom');
		$arr['airlineFrom'] = $this->input->post('airlineFrom');
		$arr['specifyTravelFrom'] = $this->input->post('specifyTravelFrom');
		$arr['airportFromFrom'] = $this->input->post('airportFromFrom');
		$arr['departureTimeFrom'] = $this->input->post('departureTimeFrom');
		$arr['confirmationFrom'] = $this->input->post('confirmationFrom');
		$arr['airportToFrom'] = $this->input->post('airportToFrom');
		$arr['arrivalTimeFrom'] = $this->input->post('arrivalTimeFrom');
		$arr['groundTransCo'] = $this->input->post('groundTransCo');
		$arr['vehicleMake'] = $this->input->post('vehicleMake');
		$arr['driverName'] = $this->input->post('driverName');
		$arr['driverPhone'] = $this->input->post('driverPhone');
		$arr['vehicleModel'] = $this->input->post('vehicleModel');
		$arr['vehicleTag'] = $this->input->post('vehicleTag');
		$arr['pickUpTime'] = $this->input->post('pickUpTime');
		$arr['dropOffTime'] = $this->input->post('dropOffTime');
		$arr['dropOffLocation'] = $this->input->post('dropOffLocation');
		$arr['groundNotes'] = $this->input->post('groundNotes');
		$arr['hotelName'] = $this->input->post('hotelName');
		$arr['hotelStay'] = $this->input->post('hotelStay');
		$arr['confirmationAccommodation'] = $this->input->post('confirmationAccommodation');
		$arr['perDiem'] = $this->input->post('perDiem');
		$arr['hotelAddress'] = $this->input->post('hotelAddress');
		$arr['roomType'] = $this->input->post('roomType');
		$arr['checkIn'] = $this->input->post('checkIn');
		$arr['checkOut'] = $this->input->post('checkOut');
		$arr['accommodationNote'] = $this->input->post('accommodationNote');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateRunOfShowTalentCrew($arr, $id);
		$this->session->set_flashdata('success', 'Talent & Crew Travel Details Update Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function deleteRunOfShowTalentCrew($id)
	{
		$this->admin->deleteRunOfShowTalentCrew($id);
		$this->session->set_flashdata('success', 'Successfully Removed..');
		redirect($_SERVER['HTTP_REFERER']);
	}

	// Run of Show POC
	function viewRunOfShowPoc($id)
	{
		$this->data['title'] = 'View Run Of Show POC';
		$this->data['data'] = $this->admin->getRunOfShowById($id);
		$this->data['pocDetails'] = $this->admin->getRunOfShowPocDetails($id);
		$this->makeView('/viewRunOfShowPoc');
	}

	function addRunOfShowPoc($id)
	{
		$this->data['runOfShowDetails'] = $this->admin->getRunOfShowById($id);
		$this->popupView('/addRunOfShowPoc');
	}

	function saveRunOfShowPoc($id)
	{
//		return dnd($_POST);
		$arr['runOfShowId'] = $id;
		$arr['name'] = $this->input->post('name');
		$arr['title'] = $this->input->post('title');
		$arr['phone'] = $this->input->post('phone');
		$arr['email'] = $this->input->post('email');
		$arr['assistantName'] = $this->input->post('assistantName');
		$arr['assistantTitle'] = $this->input->post('assistantTitle');
		$arr['assistantPhone'] = $this->input->post('assistantPhone');
		$arr['assistantEmail'] = $this->input->post('assistantEmail');
		$arr['backUpName'] = $this->input->post('backUpName');
		$arr['backUpTitle'] = $this->input->post('backUpTitle');
		$arr['backUpPhone'] = $this->input->post('backUpPhone');
		$arr['backUpEmail'] = $this->input->post('backUpEmail');
		$this->admin->saveRunOfShowPoc($arr);
		$this->session->set_flashdata('success', 'POC Details Added Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function editRunOfShowPoc($id)
	{
		$this->data['data'] = $this->admin->getRunOfShowPocById($id);
		$this->popupView('/editRunOfShowPoc');
	}

	function updateRunOfShowPoc($id)
	{
		$arr['name'] = $this->input->post('name');
		$arr['title'] = $this->input->post('title');
		$arr['phone'] = $this->input->post('phone');
		$arr['email'] = $this->input->post('email');
		$arr['assistantName'] = $this->input->post('assistantName');
		$arr['assistantTitle'] = $this->input->post('assistantTitle');
		$arr['assistantPhone'] = $this->input->post('assistantPhone');
		$arr['assistantEmail'] = $this->input->post('assistantEmail');
		$arr['backUpName'] = $this->input->post('backUpName');
		$arr['backUpTitle'] = $this->input->post('backUpTitle');
		$arr['backUpPhone'] = $this->input->post('backUpPhone');
		$arr['backUpEmail'] = $this->input->post('backUpEmail');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateRunOfShowPoc($arr, $id);
		$this->session->set_flashdata('success', 'POC Details Update Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function deleteRunOfShowPoc($id)
	{
		$this->admin->deleteRunOfShowPoc($id);
		$this->session->set_flashdata('success', 'Successfully Removed..');
		redirect($_SERVER['HTTP_REFERER']);
	}

	// Timed Access Link
	function timeAccessLink($id)
	{
		$this->data['title'] = 'Timed Access Link';
		$this->data['data'] = $this->admin->getRunOfShowById($id);
		$this->data['timedAccessLink'] = $this->admin->getTimedAccessLinkDetailsByRunOfShowId($id);
		$this->data['timedAccessLinkCrewTravel'] = $this->admin->getTimedAccessLinkCrewTravelDetailsByRunOfShowId($id);
		$this->data['timedAccessLinkTalentTravel'] = $this->admin->getTimedAccessLinkTalentTravelDetailsByRunOfShowId($id);
		$this->data['timedAccessLinkPOC'] = $this->admin->getTimedAccessLinkPocDetailsByRunOfShowId($id);
//		return dnp($this->data);
		$this->makeView('/timeAccessLink');
	}

	function addTimeAccessLink($id)
	{
		$this->data['id'] = $id;
		$this->data['runOfShowDetails'] = $this->admin->getRunOfShowScheduleDetails($id);
		$this->data['crewTravelDetails'] = $this->admin->getRunOfShowCrewTravelDetails($id);
		$this->data['talentCrewDetails'] = $this->admin->getRunOfShowTalentCrewDetails($id);
		$this->data['pocDetails'] = $this->admin->getRunOfShowPocDetails($id);
		$this->popupView('/addTimeAccessLink');
	}

	function saveTimeAccessLink($id)
	{
//		return dnp($_POST);
		$arr['runOfShowId'] = $id;
		$arr['userAccessTitle'] = $this->input->post('userAccessTitle');
		if ($this->input->post('showProduction')) {
			$arr['showProduction'] = $this->input->post('showProduction');
		}
		if ($this->input->post('showPrivateNote')) {
			$arr['showPrivateNote'] = $this->input->post('showPrivateNote');
		}
		$arr['createBy'] = getSession()->id;
		$timedAccessLinkId = $this->admin->saveTimedAccessLink($arr);

		$crewTravel = $arr['crewTravel'] = $this->input->post('crewTravel');
		if ($crewTravel) {
			foreach ($crewTravel as $ct) {
				$data = [
					'runOfShowId' => $id,
					'timedAccessLinkId' => $timedAccessLinkId,
					'crewTravelId' => $ct
				];
				$this->admin->insertCrewTravel($data);
			}
		}
		$talentTravel = $arr['talentTravel'] = $this->input->post('talentTravel');
		if ($talentTravel) {
			foreach ($talentTravel as $tt) {
				$data = [
					'runOfShowId' => $id,
					'timedAccessLinkId' => $timedAccessLinkId,
					'talentTravelId' => $tt
				];
				$this->admin->insertTalentTravel($data);
			}
		}
		$poc = $arr['poc'] = $this->input->post('poc');
		if ($poc) {
			foreach ($poc as $p) {
				$data = [
					'runOfShowId' => $id,
					'timedAccessLinkId' => $timedAccessLinkId,
					'pocId' => $p
				];
				$this->admin->insertPoc($data);
			}
		}

		$this->session->set_flashdata('success', 'Timed Access Link Successfully Saved..');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function editTimedAccessLink($id)
	{
		$timeAccessLink = $this->data['timedAccessLink'] = $this->admin->getTimedAccessLinkDetailsById($id);
		$this->data['runOfShowDetails'] = $this->admin->getRunOfShowScheduleDetails($timeAccessLink->runOfShowId);
		$this->data['crewTravelDetails'] = $this->admin->getRunOfShowCrewTravelDetails($timeAccessLink->runOfShowId);
		$this->data['talentCrewDetails'] = $this->admin->getRunOfShowTalentCrewDetails($timeAccessLink->runOfShowId);
		$this->data['pocDetails'] = $this->admin->getRunOfShowPocDetails($timeAccessLink->runOfShowId);

		$crewData = $this->admin->getTimedAccessLinkCrewTravelDetailsById($id);
		$checkedCrewTravelIds = [];
		if ($crewData) {
			foreach ($crewData as $detail) {
				$checkedCrewTravelIds[] = $detail->crewMemberId;
			}
		}
		$this->data['timedAccessLinkCrewTravel'] = $checkedCrewTravelIds;

		$talentData = $this->admin->getTimedAccessLinkTalentTravelDetailsById($id);
		$checkedTalentTravelIds = [];
		if ($talentData) {
			foreach ($talentData as $detail) {
				$checkedTalentTravelIds[] = $detail->crewMemberId;
			}
		}
		$this->data['timedAccessLinkTalentTravel'] = $checkedTalentTravelIds;

		$pocData = $this->admin->getTimedAccessLinkPocDetailsById($id);
		$checkedPocIds = [];
		if ($pocData) {
			foreach ($pocData as $detail) {
				$checkedPocIds[] = $detail->id;
			}
		}
		$this->data['timedAccessLinkPOC'] = $checkedPocIds;
		$this->popupView('/editTimedAccessLink');
	}

	function updateTimeAccessLink($id)
	{
		$arr['userAccessTitle'] = $this->input->post('userAccessTitle');
		if ($this->input->post('showProduction')) {
			$arr['showProduction'] = $this->input->post('showProduction');
		}
		if ($this->input->post('showPrivateNote')) {
			$arr['showPrivateNote'] = $this->input->post('showPrivateNote');
		}
		$arr['updateAt'] = date('Y-m-d H:i:s');

		$this->admin->updateTimedAccessLinkById($arr, $id);

		$timeAccessLink = $this->admin->getTimedAccessLinkDetailsById($id);
		$this->admin->deleteTimedAccessLinkExtend($id);

		$crewTravel = $arr['crewTravel'] = $this->input->post('crewTravel');
		if ($crewTravel) {
			foreach ($crewTravel as $ct) {
				$data = [
					'runOfShowId' => $timeAccessLink->runOfShowId,
					'timedAccessLinkId' => $id,
					'crewTravelId' => $ct
				];
				$this->admin->insertCrewTravel($data);
			}
		}
		$talentTravel = $arr['talentTravel'] = $this->input->post('talentTravel');
		if ($talentTravel) {
			foreach ($talentTravel as $tt) {
				$data = [
					'runOfShowId' => $timeAccessLink->runOfShowId,
					'timedAccessLinkId' => $id,
					'talentTravelId' => $tt
				];
				$this->admin->insertTalentTravel($data);
			}
		}
		$poc = $arr['poc'] = $this->input->post('poc');
		if ($poc) {
			foreach ($poc as $p) {
				$data = [
					'runOfShowId' => $timeAccessLink->runOfShowId,
					'timedAccessLinkId' => $id,
					'pocId' => $p
				];
				$this->admin->insertPoc($data);
			}
		}
		$this->session->set_flashdata('success', 'Timed Access Link Successfully Updated..');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function updateTimedAccessLinkStatus()
	{
		$id = $this->input->post('id');
		$arr['status'] = $this->input->post('status');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateTimedAccessLinkById($arr, $id);
		echo json_encode(array('status' => 'success'));
	}

	function viewTimedAccessLink($id)
	{
		$timeAccessLink = $this->data['timedAccessLink'] = $this->admin->getTimedAccessLinkDetailsById($id);
		$this->data['data'] = $this->admin->getRunOfShowById($timeAccessLink->runOfShowId);
//		return dnp($timeAccessLink->showProduction);
		if ($timeAccessLink->showProduction == 1) {
			$this->data['runOfShowDetails'] = $this->admin->getRunOfShowScheduleDetails($timeAccessLink->runOfShowId);
		}
		$this->data['timedAccessLinkCrewTravel'] = $this->admin->getTimedAccessLinkCrewTravelDetailsById($id);
		$this->data['timedAccessLinkTalentTravel'] = $this->admin->getTimedAccessLinkTalentTravelDetailsById($id);
		$this->data['timedAccessLinkPOC'] = $this->admin->getTimedAccessLinkPocDetailsById($id);
		$this->popupView('/viewTimedAccessLink');
	}

	function deleteTimedAccessLink($id)
	{
		$this->admin->deleteTimedAccessLink($id);
		$this->admin->deleteTimedAccessLinkExtend($id);
		$this->session->set_flashdata('success', 'Timed Access Link Successfully Removed..');
		redirect($_SERVER['HTTP_REFERER']);
	}

	// project KPT
	function project()
	{
		$this->data['title'] = 'Project KPI';
		$this->makeView('/project');
	}

	function addProject()
	{
		$this->popupView('/addProject');
	}

	function getProjects()
	{
		$action = '<div class="dropdown">
		<button class="btn btn-sm dropdown-toggle" style="color: white; background-color: black" type="button" data-toggle="dropdown">Actions
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/projectOverview/$1') . '\')">Overview</a></li>
			<li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/projectTeamKpi/$1') . '\')">Team KPI</a></li>
			<li><a href="' . base_url('admin/changeProjectArchiveStatus/$1') . '" onclick="return confirm(\'Are you sure?\')">Archive</a></li>
			<li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/editProject/$1') . '\')">Edit</a></li>
			<li><a href="' . base_url('admin/deleteProject/$1') . '" onclick="return confirm(\'Are you sure?\')">Delete</a></li>
		</ul>
	  </div>';
		$this->datatables->select('r.id as id, p.title, r.description, r.updateAt');
		$this->datatables->from(TABLE_PROJECTS . ' as r');
		$this->datatables->join(TABLE_PRODUCTIONS . ' as p', 'r.productionId = p.id');
		$this->datatables->where(array('r.archivesStatus' => 0));
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}

	function changeProjectArchiveStatus($id)
	{
		$arr['archivesStatus'] = 1;
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateProject($arr, $id);
		$this->session->set_flashdata('success', 'Project Marked Archived Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function updateProject($id)
	{
		$ar['productionId'] = $this->input->post('productionId');
		$ar['description'] = $this->input->post('description');
		$ar['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateProject($ar, $id);
		$this->session->set_flashdata('success', 'Project Updated Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function saveProject()
	{
		$ar['productionId'] = $this->input->post('productionId');
		$ar['description'] = $this->input->post('description');
		$this->admin->saveProject($ar);
		$project['projectId'] = $this->db->insert_id();
		$this->admin->saveProjectOverview($project);
		$this->session->set_flashdata('success', 'Project Added Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function editProject($id)
	{
		$this->data['data'] = $this->admin->getProjectById($id);
		$this->popupView('/editProject');
	}

	function deleteProject($id)
	{
		$this->admin->deleteProject($id);
		$this->admin->deleteProjectOverview($id);
		$this->session->set_flashdata('success', 'Project Deleted Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function archivesProject()
	{
		$this->data['title'] = 'Archives Project KPI';
		$this->makeView('/archivesProject');
	}

	function getArchivesProjects()
	{
		$action = '<div class="dropdown">
		<button class="btn btn-sm dropdown-toggle" style="color: white; background-color: black" type="button" data-toggle="dropdown">Actions
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<li><a href="' . base_url('admin/changeProjectUnarchivedStatus/$1') . '" onclick="return confirm(\'Are you sure?\')">Unarchived</a></li>
			<li><a href="' . base_url('admin/deleteProject/$1') . '" onclick="return confirm(\'Are you sure?\')">Delete</a></li>
		</ul>
	  </div>';
		$this->datatables->select('r.id as id, p.title, r.description, r.updateAt');
		$this->datatables->from(TABLE_PROJECTS . ' as r');
		$this->datatables->join(TABLE_PRODUCTIONS . ' as p', 'r.productionId = p.id');
		$this->datatables->where(array('r.archivesStatus' => 1));
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}

	function changeProjectUnarchivedStatus($id)
	{
		$arr['archivesStatus'] = 0;
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateProject($arr, $id);
		$this->session->set_flashdata('success', 'Project marked Unarchived Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	// project overview
	function overviewProject($id)
	{
		$this->data['title'] = 'Project Overview';
		$this->data['data'] = $this->admin->getProjectById($id);
		$this->data['projectOverview'] = $this->admin->getProjectOverviewByProjectId($id);
		$this->makeView('/overviewProject');
	}

	function updateProjectOverview($id)
	{
//		return dnp($_POST);
		$arr['synopsis'] = $this->input->post('synopsis');
		$arr['about'] = $this->input->post('about');
		$arr['intentions'] = $this->input->post('intentions');
		$arr['problemStatement'] = $this->input->post('problemStatement');
		$arr['proposedSolution'] = $this->input->post('proposedSolution');
		$arr['risks'] = $this->input->post('risks');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateProjectOverview($arr, $id);
		$this->session->set_flashdata('success', 'Project Overview Saved Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function viewProjectOverview($id)
	{
		$this->data['data'] = $this->admin->getProjectById($id);
		$this->data['projectOverview'] = $this->admin->getProjectOverviewByProjectId($id);
		$this->popupView('/viewProjectOverview');
	}

	// project KPI
	function projectKpi($id)
	{
		$this->data['title'] = 'Project KPI';

		// Get all titles for the given project ID
		$titles = $this->admin->getProjectKPITitleByProjectId($id);

		foreach ($titles as $title) {
			// Get all items under the current title
			$items = $this->admin->getProjectKPIItemsByTitleId($title->id);

			foreach ($items as $item) {
				// Initialize an empty data array for updates
				$itemData = [];

				// Parse the current date and the item's due date
				$currentDate = new DateTime();
				$dueDate = new DateTime($item->dueDate);

				// Check if the due date has passed and the status is not "Completed"
				if (($item->status !== "Completed" && $item->status !== "Blocked") && $dueDate < $currentDate) {
					$itemData['status'] = 'Late'; // Mark the item as late
				}

				// Update the item in the database only if changes are needed
				if (!empty($itemData)) {
					$this->admin->updateProjectKPIItemById($itemData, $item->id);
				}
			}
		}

		// Pass the necessary data to the view
		$this->data['data'] = $this->admin->getProjectById($id);
		$this->data['projectKpiDetails'] = $this->admin->getProjectKpiDetails($id);
		$this->makeView('/projectKpi');
	}


	function addProjectKpiTitle($id)
	{
		$this->data['id'] = $id;
		$this->data['okr'] = $this->admin->getProjectKPITitleLastOkr($id) ? $this->admin->getProjectKPITitleLastOkr($id)->okr + 1 : 1;
		$this->popupView('/addProjectKpiTitle');
	}

	function editProjectKpiTitle($id)
	{
		$this->data['data'] = $this->admin->getProjectKPITitleById($id);
		$this->popupView('/editProjectKpiTitle');
	}

	function updateProjectKpiTitle($id)
	{
		$arr['productionPhase'] = $this->input->post('productionPhase');
		$arr['timelineTrack'] = $this->input->post('timelineTrack');
		$arr['timelineGoal'] = $this->input->post('timelineGoal');
		$arr['timelineAction'] = $this->input->post('timelineAction');
		$timelineView = $arr['timelineView'] = $this->input->post('timelineView') ? $this->input->post('timelineView') : 0;
		$milestoneMark = $arr['milestoneMark'] = $this->input->post('milestoneMark') ? $this->input->post('milestoneMark') : 0;
		$arr['startDate'] = date('Y-m-d', strtotime($this->input->post('startDate')));
		$arr['dueDate'] = date('Y-m-d', strtotime($this->input->post('dueDate')));
		$arr['qtr'] = $this->input->post('qtr');
//		$arr['status'] = $this->input->post('status');
		$arr['responsibleId'] = $this->input->post('responsibleId');
		$arr['accountableId'] = $this->input->post('accountableId');
		$arr['consultedId'] = $this->input->post('consultedId');
		$arr['informedId'] = $this->input->post('informedId');
		$arr['xfnName'] = $this->input->post('xfnName');
		$arr['xfnEmail'] = $this->input->post('xfnEmail');
		$arr['studioFloName'] = $this->input->post('studioFloName');
		$arr['studioFloDirectory'] = $this->input->post('studioFloDirectory');
		$this->admin->updateProjectKPITitleById($arr, $id);
		$ar = [];
		$titleDetails = $this->admin->getProjectKPIItemsByTitleId($id);
		if ($titleDetails) {
			foreach ($titleDetails as $titleDetail) {
				if ($timelineView == 1) {
					$ar['timelineView'] = 1;
				} else {
					$ar['timelineView'] = 0;
				}
				if ($milestoneMark == 1) {
					$ar['milestoneMark'] = 1;
				} else {
					$ar['milestoneMark'] = 0;
				}
				$this->admin->updateProjectKPIItemById($ar, $titleDetail->id);
			}
		}
		$this->session->set_flashdata('success', 'Project KPI Objective Saved Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function saveProjectKpiTitle($id)
	{
//		return dnp($_POST);
		$arr['projectId'] = $id;
		$arr['type'] = $this->input->post('type');
		$arr['okr'] = $this->input->post('okr');
		$arr['productionPhase'] = $this->input->post('productionPhase');
		$arr['timelineTrack'] = $this->input->post('timelineTrack');
		$arr['timelineGoal'] = $this->input->post('timelineGoal');
		$arr['timelineAction'] = $this->input->post('timelineAction');
		$arr['timelineView'] = $this->input->post('timelineView') ? $this->input->post('timelineView') : 0;
		$arr['milestoneMark'] = $this->input->post('milestoneMark') ? $this->input->post('milestoneMark') : 0;
		$arr['startDate'] = date('Y-m-d', strtotime($this->input->post('startDate')));
		$arr['dueDate'] = date('Y-m-d', strtotime($this->input->post('dueDate')));
		$arr['qtr'] = $this->input->post('qtr');
		$arr['status'] = $this->input->post('status');
		$arr['responsibleId'] = $this->input->post('responsibleId');
		$arr['accountableId'] = $this->input->post('accountableId');
		$arr['consultedId'] = $this->input->post('consultedId');
		$arr['informedId'] = $this->input->post('informedId');
		$arr['xfnName'] = $this->input->post('xfnName');
		$arr['xfnEmail'] = $this->input->post('xfnEmail');
		$arr['studioFloName'] = $this->input->post('studioFloName');
		$arr['studioFloDirectory'] = $this->input->post('studioFloDirectory');
		$this->admin->saveProjectKpiTitle($arr);
		$this->session->set_flashdata('success', 'Project KPI Objective Saved Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function deleteProjectKpiTitle($titleId)
	{
		$this->admin->deleteProjectKpiTitle($titleId);
		$this->session->set_flashdata('success', 'Project KPI Objective Removed Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function deleteProjectKpiItem($titleId, $itemId)
	{
		$this->admin->deleteProjectKpiItem($itemId);

		$ar = [];
		$metric = 0;
		$titleDetails = $this->admin->getProjectKPIItemsByTitleId($titleId);
		$totalDetails = count($titleDetails);
		foreach ($titleDetails as $titleDetail) {
			$metric += $titleDetail->metrics;
			$averageMetrics = $ar['metrics'] = round($metric / $totalDetails, 2);
			if ($averageMetrics == 100) {
				$ar['markedDate'] = date('Y-m-d');
				$ar['status'] = 'Completed';
			} else if ($averageMetrics > 0 && $averageMetrics <= 100) {
				$ar['markedDate'] = null;
				$ar['status'] = 'In-Progress';
			} else {
				$ar['markedDate'] = null;
				$ar['status'] = 'Not Started';
			}
		}
		$this->admin->updateProjectKPITitleById($ar, $titleId);
		$this->session->set_flashdata('success', 'Project KPI Key Result Removed Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function addProjectKpiItem($projectId, $titleId)
	{
		$items = $this->admin->getProjectKPIItemsByTitleId($titleId);
		$this->data['okr'] = count($items) + 1;
		$this->data['projectId'] = $projectId;
		$this->data['titleDetails'] = $this->admin->getProjectKPITitleById($titleId);
		$this->popupView('/addProjectKpiItem');
	}

	function updateProjectKpiItem($id)
	{
		$projectId = $this->input->post('projectId');
		$titleId = $this->input->post('titleId');
		$arr['timelineGoal'] = $this->input->post('timelineGoal');
		$arr['timelineAction'] = $this->input->post('timelineAction');
		$arr['startDate'] = date('Y-m-d', strtotime($this->input->post('startDate')));
		$arr['dueDate'] = date('Y-m-d', strtotime($this->input->post('dueDate')));
		$arr['qtr'] = $this->input->post('qtr');
		$status = $arr['status'] = $this->input->post('status');
		$arr['responsibleId'] = $this->input->post('responsibleId');
		$arr['accountableId'] = $this->input->post('accountableId');
		$arr['consultedId'] = $this->input->post('consultedId');
		$arr['informedId'] = $this->input->post('informedId');
		$arr['xfnName'] = $this->input->post('xfnName');
		$arr['xfnEmail'] = $this->input->post('xfnEmail');
		$arr['studioFloName'] = $this->input->post('studioFloName');
		$arr['studioFloDirectory'] = $this->input->post('studioFloDirectory');
		$arr['timelineView'] = $this->input->post('timelineView') ? $this->input->post('timelineView') : 0;
		$arr['milestoneMark'] = $this->input->post('milestoneMark') ? $this->input->post('milestoneMark') : 0;
		if ($status == 'Completed') {
			$arr['metrics'] = 100;
			$arr['markedDate'] = date('Y-m-d');
			$arr['blockReason'] = '';
		} else if ($status == 'In-Progress') {
			$arr['markedDate'] = null;
			$arr['metrics'] = 50;
			$arr['blockReason'] = '';
		} else if ($status == 'Blocked') {
			$arr['markedDate'] = null;
			$arr['metrics'] = 0;
			$arr['blockReason'] = $this->input->post('blockReason');
		} else {
			$arr['markedDate'] = null;
			$arr['metrics'] = 0;
			$arr['blockReason'] = '';
		}
		$this->admin->updateProjectKPIItemById($arr, $id);
		$ar = [];
		$metric = 0;
		$titleDetails = $this->admin->getProjectKPIItemsByTitleId($titleId);
		$totalDetails = count($titleDetails);
		foreach ($titleDetails as $titleDetail) {
			$metric += $titleDetail->metrics;
			$averageMetrics = $ar['metrics'] = round($metric / $totalDetails, 2);
			if ($averageMetrics == 100) {
				$ar['markedDate'] = date('Y-m-d');
				$ar['status'] = 'Completed';
			} else if ($averageMetrics > 0 && $averageMetrics <= 100) {
				$ar['markedDate'] = null;
				$ar['status'] = 'In-Progress';
			} else {
				$ar['markedDate'] = null;
				$ar['status'] = 'Not Started';
			}
		}
		$timelineViewResult = 1;
		$milestoneMarkResult = 1;
		foreach ($titleDetails as $titleDetail) {
			if ($titleDetail->timelineView == 0) {
				$timelineViewResult = 0;
			}
			if ($titleDetail->milestoneMark == 0) {
				$milestoneMarkResult = 0;
			}
		}
		$ar['timelineView'] = $timelineViewResult;
		$ar['milestoneMark'] = $milestoneMarkResult;
		$this->admin->updateProjectKPITitleById($ar, $titleId);
		$this->session->set_flashdata('success', 'Project KPI Key Result Saved Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function saveProjectKpiItem()
	{
//		return dnp($_POST);
		$projectId = $arr['projectId'] = $this->input->post('projectId');
		$titleId = $arr['title_id'] = $this->input->post('titleId');
		$arr['type'] = $this->input->post('type');
		$arr['okr'] = $this->input->post('okr');
		$arr['timelineGoal'] = $this->input->post('timelineGoal');
		$arr['timelineAction'] = $this->input->post('timelineAction');
		$arr['startDate'] = date('Y-m-d', strtotime($this->input->post('startDate')));
		$arr['dueDate'] = date('Y-m-d', strtotime($this->input->post('dueDate')));
		$arr['qtr'] = $this->input->post('qtr');
		$status = $arr['status'] = $this->input->post('status');
		$arr['responsibleId'] = $this->input->post('responsibleId');
		$arr['accountableId'] = $this->input->post('accountableId');
		$arr['consultedId'] = $this->input->post('consultedId');
		$arr['informedId'] = $this->input->post('informedId');
		$arr['xfnName'] = $this->input->post('xfnName');
		$arr['xfnEmail'] = $this->input->post('xfnEmail');
		$arr['studioFloName'] = $this->input->post('studioFloName');
		$arr['studioFloDirectory'] = $this->input->post('studioFloDirectory');
		$arr['timelineView'] = $this->input->post('timelineView') ? $this->input->post('timelineView') : 0;
		$arr['milestoneMark'] = $this->input->post('milestoneMark') ? $this->input->post('milestoneMark') : 0;
		if ($status == 'In-Progress') {
			$arr['metrics'] = 50;
			$arr['blockReason'] = '';
		} else if ($status == 'Completed') {
			$arr['metrics'] = 100;
			$arr['blockReason'] = '';
		} else if ($status == 'Blocked') {
			$arr['metrics'] = 0;
			$arr['blockReason'] = $this->input->post('blockReason');
		}
		$this->admin->saveProjectKpiItem($arr);
		$ar = [];
		$metric = 0;
		$titleDetails = $this->admin->getProjectKPIItemsByTitleId($titleId);
		$totalDetails = count($titleDetails);
		foreach ($titleDetails as $titleDetail) {
			$metric += $titleDetail->metrics;
			$ar['metrics'] = round($metric / $totalDetails, 2);
			if ($titleDetail->timelineView == 1) {
				$ar['timelineView'] = 1;
			} else {
				$ar['timelineView'] = 0;
			}
			if ($titleDetail->milestoneMark == 1) {
				$ar['milestoneMark'] = 1;
			} else {
				$ar['milestoneMark'] = 0;
			}
		}
//		return dnp($ar);
		$this->admin->updateProjectKPITitleById($ar, $titleId);
		$this->session->set_flashdata('success', 'Project KPI Key Result Saved Successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function editProjectKpiItem($id)
	{
		$this->data['data'] = $this->admin->getProjectKPIItemsById($id);
		$this->popupView('/editProjectKpiItem');
	}

	function viewProjectKPIItemBlockReason($id)
	{
		$this->data['data'] = $this->admin->getProjectKPIItemsById($id);
		$this->popupView('/viewProjectKpiItemBlockReason');
	}

	function roadmap()
	{
		$this->data['title'] = 'Roadmap';
		$this->makeView('/roadmap');
	}

	function roadmap1()
	{
		$this->data['title'] = 'Roadmap';
		$this->makeView('/roadmap1');
	}
}
