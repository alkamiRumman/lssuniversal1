<?php

class Admin_model extends CI_Model
{
	function __construct()
	{
	}

	function totalUser()
	{
		$this->db->select('*');
		$this->db->from(TABLE_USERS);
		$this->db->where(array('id !=' => getSession()->id, 'type !=' => 'Vendor', 'deleted' => 0));
		return $this->db->get()->num_rows();
	}

	function totalVendor()
	{
		$this->db->select('*');
		$this->db->from(TABLE_USERS);
		$this->db->where('type', 'Vendor');
		$this->db->where('deleted', 0);
		return $this->db->get()->num_rows();
	}

	function totalCompleteProduction()
	{
		$this->db->select('p.*');
		$this->db->from(TABLE_PRODUCTIONS . ' as p');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where('p.completedStatus', 'Complete');
		return $this->db->get()->num_rows();
	}

	function totalIncompleteProduction()
	{
		$this->db->select('p.*');
		$this->db->from(TABLE_PRODUCTIONS . ' as p');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where('p.completedStatus', 'In-progress');
		return $this->db->get()->num_rows();
	}

	function totalInvoices()
	{
		$this->db->select('vv.*');
		$this->db->from(TABLE_VENDORINVOICE . ' as vv');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'vv.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		return $this->db->get()->num_rows();
	}

	function totalPaidInvoices()
	{
		$this->db->select('vv.*');
		$this->db->from(TABLE_VENDORINVOICE . ' as vv');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'vv.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where(array('vv.status' => 'Paid'));
		return $this->db->get()->num_rows();
	}

	function totalUnpaidInvoices()
	{
		$this->db->select('vv.*');
		$this->db->from(TABLE_VENDORINVOICE . ' as vv');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'vv.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where(array('vv.status' => 'Unpaid'));
		return $this->db->get()->num_rows();
	}

	function totalRejectedInvoices()
	{
		$this->db->select('vv.*');
		$this->db->from(TABLE_VENDORINVOICE . ' as vv');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'vv.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where(array('vv.status' => 'Rejected'));
		return $this->db->get()->num_rows();
	}

	function getCustomers()
	{
		$this->db->select('*');
		$this->db->from(TABLE_USERS);
		$this->db->where(array('id !=' => getSession()->id));
		return $this->db->get();
	}

	function getCustomerSearch($searchTerm = "")
	{
		$this->db->select('*, name as text');
		$this->db->from(TABLE_USERS);
		$this->db->where("name like '%" . $searchTerm . "%'");
		$value = $this->db->get()->result();
		$data = array();
		foreach ($value as $val) {
			if ($val->deleted == 0 && $val->type != 'Admin') {
				$data[] = $val;
			}
		}
		return $data;
	}

	function getVendorSearch($searchTerm = "")
	{
		$this->db->select('*, name as text');
		$this->db->from(TABLE_USERS);
		$this->db->where("name like '%" . $searchTerm . "%'");
		$value = $this->db->get()->result();
		$data = array();
		foreach ($value as $val) {
			if ($val->deleted == 0 && $val->type == 'Vendor') {
				$data[] = $val;
			}
		}
		return $data;
	}

	function getTotalCustomerStatus()
	{
		$this->db->select('p.*');
		$this->db->from(TABLE_PRODUCTIONS . ' as p');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where('p.customerStatus', 1);
		$this->db->where('p.status', 1);
		return $this->db->get()->num_rows();
	}

	function getProductionSearch($searchTerm = "")
	{
		$this->db->select('p.*, p.title as text, v.venueName');
		$this->db->from(TABLE_PRODUCTIONS . ' as p');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where("p.title like '%" . $searchTerm . "%' or p.id like '%" . $searchTerm . "%'");
		$value = $this->db->get()->result();
		$data = array();
		foreach ($value as $val) {
			if ($val->completedStatus == 'Green Lit' || $val->completedStatus == 'Wrapped') {
				$data[] = $val;
			}
		}
		return $data;
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

	function saveCustomer($arr)
	{
		$this->db->insert(TABLE_USERS, $arr);
	}

	function getCustomerById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_USERS);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	function updateCustomer($arr, $id)
	{
		$this->db->update(TABLE_USERS, $arr, array('id' => $id));
	}

	function deleteCustomer($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_USERS);
	}

	// production

	function getVenueSearch($searchTerm = "")
	{
		$this->db->select('*, venueName as text');
		$this->db->from(TABLE_VENUE);
		$this->db->where("venueName like '%" . $searchTerm . "%'");
		$value = $this->db->get()->result();
		$data = array();
		foreach ($value as $val) {
			$data[] = $val;
		}
		return $data;
	}

	function save($arr)
	{
		$this->db->insert(TABLE_PRODUCTIONS, $arr);
	}

	function update($arr, $id)
	{
		$this->db->update(TABLE_PRODUCTIONS, $arr, array('id' => $id));
	}

	function getProductionById($id)
	{
		$this->db->select('p.*, v.venueName, v.address, v.city, v.state, v.zip');
		$this->db->from(TABLE_PRODUCTIONS . ' as p');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where('p.id', $id);
		return $this->db->get()->row();
	}

	function getProductionCheckById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_PRODUCTIONS);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	// Production
	function getLastProductionID()
	{
		$this->db->select('id, status');
		$this->db->from(TABLE_PRODUCTIONS);
		$this->db->order_by('id', 'desc');
		return $this->db->get()->row();
	}

	function getLastProductionIDByUser()
	{
		$this->db->select('id, status');
		$this->db->from(TABLE_PRODUCTIONS);
		$this->db->where('addedBy', getSession()->id);
		$this->db->order_by('id', 'desc');
		return $this->db->get()->row();
	}

	function deleteProduction($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_PRODUCTIONS);
	}

	//Crew Member
	function saveCrewMember($arr)
	{
		$this->db->insert(TABLE_CREWMEMBERS, $arr);
	}

	function getCrewMemberByProductionId($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_CREWMEMBERS);
		$this->db->where('productionId', $id);
		$this->db->order_by('id', 'asc');
		return $this->db->get()->result();
	}

	function getCrewMemberById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_CREWMEMBERS);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	function updateCrewMember($arr, $id)
	{
		$this->db->update(TABLE_CREWMEMBERS, $arr, array('id' => $id));
	}

	function deleteCrewMember($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_CREWMEMBERS);
	}

	function deleteCrewMemberByProductionId($id)
	{
		$this->db->where('productionId', $id);
		$this->db->delete(TABLE_CREWMEMBERS);
	}

	//Theatre Crew Member
	function saveTheatreCrew($arr)
	{
		$this->db->insert(TABLE_THEATRECREW, $arr);
	}

	function getTheatreCrewByProductionId($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_THEATRECREW);
		$this->db->where('productionId', $id);
		$this->db->order_by('id', 'asc');
		return $this->db->get()->result();
	}

	function getTheatreCrewById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_THEATRECREW);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	function updateTheatreCrew($arr, $id)
	{
		$this->db->update(TABLE_THEATRECREW, $arr, array('id' => $id));
	}

	function deleteTheatreCrew($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_THEATRECREW);
	}

	function deleteTheatreCrewByProductionId($id)
	{
		$this->db->where('productionId', $id);
		$this->db->delete(TABLE_THEATRECREW);
	}

	// Entertainer
	function saveEntertainer($arr)
	{
		$this->db->insert(TABLE_ENTERTAINER, $arr);
	}

	function getEntertainerByProductionId($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_ENTERTAINER);
		$this->db->where('productionId', $id);
		$this->db->order_by('id', 'asc');
		return $this->db->get()->result();
	}

	function getEntertainerById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_ENTERTAINER);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	function updateEntertainer($arr, $id)
	{
		$this->db->update(TABLE_ENTERTAINER, $arr, array('id' => $id));
	}

	function deleteEntertainer($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_ENTERTAINER);
	}

	function deleteEntertainerByProductionId($id)
	{
		$this->db->where('productionId', $id);
		$this->db->delete(TABLE_ENTERTAINER);
	}

	//Marketing Fee
	function saveMarketingFee($arr)
	{
		$this->db->insert(TABLE_MARKETINGFEE, $arr);
	}

	function getMarketingFeeByProductionId($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_MARKETINGFEE);
		$this->db->where('productionId', $id);
		$this->db->order_by('id', 'asc');
		return $this->db->get()->result();
	}

	function getMarketingFeeById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_MARKETINGFEE);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	function updateMarketingFee($arr, $id)
	{
		$this->db->update(TABLE_MARKETINGFEE, $arr, array('id' => $id));
	}

	function deleteMarketingFee($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_MARKETINGFEE);
	}

	function deleteMarketingFeeByProductionId($id)
	{
		$this->db->where('productionId', $id);
		$this->db->delete(TABLE_MARKETINGFEE);
	}


	//Rentals & Misc Fee
	function saveRentalAndMisc($arr)
	{
		$this->db->insert(TABLE_RENTALANDMISC, $arr);
	}

	function getRentalAndMiscByProductionId($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_RENTALANDMISC);
		$this->db->where('productionId', $id);
		$this->db->order_by('id', 'asc');
		return $this->db->get()->result();
	}

	function getRentalAndMiscById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_RENTALANDMISC);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	function updateRentalAndMisc($arr, $id)
	{
		$this->db->update(TABLE_RENTALANDMISC, $arr, array('id' => $id));
	}

	function deleteRentalAndMisc($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_RENTALANDMISC);
	}

	function deleteRentalAndMiscByProductionId($id)
	{
		$this->db->where('productionId', $id);
		$this->db->delete(TABLE_RENTALANDMISC);
	}

	function saveVendorInvoice($arr)
	{
		$this->db->insert(TABLE_VENDORINVOICE, $arr);
	}

	function getLastVendorInvoiceIdByToday()
	{
		$this->db->select('*');
		$this->db->from(TABLE_VENDORINVOICE);
		$this->db->where('submissionDate', date('Y-m-d'));
		$this->db->order_by('id', 'DESC');
		return $this->db->get()->row();
	}

	function getVendorInvoiceById($id)
	{
		$this->db->select('v.*, u.name, u.phone, u.username, u.businessName, u.ein, u.businessAddress, u.city, u.state,
		 	p.title, p.eventMonth, p.eventYear, vv.venueName');
		$this->db->from(TABLE_VENDORINVOICE . ' as v');
		$this->db->join(TABLE_USERS . ' as u', 'v.vendorId = u.id');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'v.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as vv', 'p.venueId = vv.id');
		$this->db->where('v.id', $id);
		return $this->db->get()->row();
	}

	function saveVendorInvoiceDetails($arr)
	{
		$this->db->insert(TABLE_VENDORINVOICEDETAILS, $arr);
	}

	function getVendorDetailsInvoiceById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_VENDORINVOICEDETAILS);
		$this->db->where('vendorInvoiceId', $id);
		return $this->db->get()->result();
	}

	function getTotalVendorStatus()
	{
		$this->db->select('v.*');
		$this->db->from(TABLE_VENDORINVOICE . ' as v');
		$this->db->join(TABLE_USERS . ' as u', 'v.vendorId = u.id');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'v.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as vv', 'p.venueId = vv.id');
		$this->db->where('v.vendorStatus', 1);
		return $this->db->get()->num_rows();
	}

	function updateVendorInvoice($arr, $id)
	{
		$this->db->update(TABLE_VENDORINVOICE, $arr, array('id' => $id));
	}

	function deleteVendorInvoiceDetailsByInvoiceId($id)
	{
		$this->db->where('vendorInvoiceId', $id);
		$this->db->delete(TABLE_VENDORINVOICEDETAILS);
	}

	function deleteVendorInvoiceById($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_VENDORINVOICE);
	}

	// venue
	function saveVenue($arr)
	{
		$this->db->insert(TABLE_VENUE, $arr);
	}

	function getVenueById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_VENUE);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	function updateVenue($arr, $id)
	{
		$this->db->update(TABLE_VENUE, $arr, array('id' => $id));
	}

	function deleteVenue($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_VENUE);
	}

	function saveVenuePoc($arr)
	{
		$this->db->insert(TABLE_VENUEPOC, $arr);
	}

	function getVenuePocById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_VENUEPOC);
		$this->db->where('venueId', $id);
		return $this->db->get()->result();
	}

	function deleteVenuePoc($id)
	{
		$this->db->where('venueId', $id);
		$this->db->delete(TABLE_VENUEPOC);
	}

	function saveVenueAttachment($arr)
	{
		$this->db->insert(TABLE_VENUEATTACHMENT, $arr);
	}

	function getVenueAttachmentById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_VENUEATTACHMENT);
		$this->db->where('venueId', $id);
		return $this->db->get()->result();
	}

	function updateVenueAttachment($arr, $id)
	{
		$this->db->update(TABLE_VENUEATTACHMENT, $arr, array('id' => $id));
	}

	function getVenueAttachmentPdfById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_VENUEATTACHMENT);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	function deleteVenueAttachment($id)
	{
		$this->db->where('venueId', $id);
		$this->db->delete(TABLE_VENUEATTACHMENT);
	}

	// run of show
	function saveRunOfShow($arr)
	{
		$this->db->insert(TABLE_RUNOFSHOW, $arr);
	}

	function getRunOfShowById($id)
	{
		$this->db->select('r.*, p.title, p.eventMonth, p.eventYear, v.venueName, v.address, v.city, v.state, v.zip');
		$this->db->from(TABLE_RUNOFSHOW . ' as r');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'r.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where('r.id', $id);
		return $this->db->get()->row();
	}

	function updateRunOfShow($arr, $id)
	{
		$this->db->update(TABLE_RUNOFSHOW, $arr, array('id' => $id));
	}

	function deleteRunOfShow($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_RUNOFSHOW);
	}

	public function insertRunOfShowScheduleTitle($data)
	{
		$this->db->insert(TABLE_RUNOFSHOWTITLES, $data);
		return $this->db->insert_id(); // Return the inserted title ID
	}

	public function insertRunOfShowScheduleItem($data)
	{
		$this->db->insert(TABLE_RUNOFSHOWITEMS, $data);
	}

	public function getRunOfShowScheduleDetails($runId)
	{
		$this->db->select('t.*, i.*');
		$this->db->from(TABLE_RUNOFSHOWTITLES . ' as t');
		$this->db->join(TABLE_RUNOFSHOWITEMS . ' as i', 't.id = i.title_id', 'left');
		$this->db->where('t.productionId', $runId);
		return $this->db->get()->result_array();
	}

	public function deleteRunOfShowDetailsByRunId($runId)
	{
		// Delete items first to avoid foreign key constraint issues
		$this->db->where('productionId', $runId);
		$this->db->delete(TABLE_RUNOFSHOWITEMS); // Assuming 'items' is the table where individual rows are stored

		// Now delete titles
		$this->db->where('productionId', $runId);
		$this->db->delete(TABLE_RUNOFSHOWTITLES); // Assuming 'titles' is the table where title rows are stored
	}


	// Crew Travel
	function saveRunOfShowCrewTravel($arr)
	{
		$this->db->insert(TABLE_RUNOFSHOWCREWTRAVEL, $arr);
	}

	function updateRunOfShowCrewTravel($arr, $id)
	{
		$this->db->update(TABLE_RUNOFSHOWCREWTRAVEL, $arr, array('id' => $id));
	}

	function deleteRunOfShowCrewTravel($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_RUNOFSHOWCREWTRAVEL);
	}

	function getCrewMemberSearch($searchTerm = "", $id)
	{
		$this->db->select('*, firstName as text');
		$this->db->from(TABLE_CREWMEMBERS);
		$this->db->where("firstName like '%" . $searchTerm . "%'");
		$this->db->where('productionId', $id);
		$value = $this->db->get()->result();
		$data = array();
		foreach ($value as $val) {
			$data[] = $val;
		}
		return $data;
	}

	public function getRunOfShowCrewTravelDetails($id)
	{
		$this->db->select('t.*, i.firstName, i.lastName');
		$this->db->from(TABLE_RUNOFSHOWCREWTRAVEL . ' as t');
		$this->db->join(TABLE_CREWMEMBERS . ' as i', 't.crewMemberId = i.id');
		$this->db->where('t.productionId', $id);
		return $this->db->get()->result();
	}

	public function getRunOfShowCrewTravelById($id)
	{
		$this->db->select('t.*, i.firstName, i.lastName');
		$this->db->from(TABLE_RUNOFSHOWCREWTRAVEL . ' as t');
		$this->db->join(TABLE_CREWMEMBERS . ' as i', 't.crewMemberId = i.id');
		$this->db->where('t.id', $id);
		return $this->db->get()->row();
	}

	// talent Crew
	function getTalentCrewMemberSearch($searchTerm = "", $id)
	{
		$this->db->select('*, firstName as text');
		$this->db->from(TABLE_ENTERTAINER);
		$this->db->where("firstName like '%" . $searchTerm . "%'");
		$this->db->where('productionId', $id);
		$value = $this->db->get()->result();
		$data = array();
		foreach ($value as $val) {
			$data[] = $val;
		}
		return $data;
	}

	public function getRunOfShowTalentCrewDetails($id)
	{
		$this->db->select('t.*, i.firstName, i.lastName');
		$this->db->from(TABLE_RUNOFSHOWTALENTCREW . ' as t');
		$this->db->join(TABLE_ENTERTAINER . ' as i', 't.crewMemberId = i.id');
		$this->db->where('t.productionId', $id);
		return $this->db->get()->result();
	}

	function saveRunOfShowTalentCrew($arr)
	{
		$this->db->insert(TABLE_RUNOFSHOWTALENTCREW, $arr);
	}

	public function getRunOfShowTalentCrewById($id)
	{
		$this->db->select('t.*, i.firstName, i.lastName');
		$this->db->from(TABLE_RUNOFSHOWTALENTCREW . ' as t');
		$this->db->join(TABLE_ENTERTAINER . ' as i', 't.crewMemberId = i.id');
		$this->db->where('t.id', $id);
		return $this->db->get()->row();
	}

	function updateRunOfShowTalentCrew($arr, $id)
	{
		$this->db->update(TABLE_RUNOFSHOWTALENTCREW, $arr, array('id' => $id));
	}

	function deleteRunOfShowTalentCrew($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_RUNOFSHOWTALENTCREW);
	}

	// Run of Show POC
	public function getRunOfShowPocDetails($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_RUNOFSHOWPOC);
		$this->db->where('productionId', $id);
		return $this->db->get()->result();
	}

	function saveRunOfShowPoc($arr)
	{
		$this->db->insert(TABLE_RUNOFSHOWPOC, $arr);
	}

	public function getRunOfShowPocById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_RUNOFSHOWPOC);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	function updateRunOfShowPoc($arr, $id)
	{
		$this->db->update(TABLE_RUNOFSHOWPOC, $arr, array('id' => $id));
	}

	function deleteRunOfShowPoc($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_RUNOFSHOWPOC);
	}

}
