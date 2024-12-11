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
			if ($val->deleted == 0 && $val->type == 'Customer') {
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

	function update($arr, $id)
	{
		$this->db->update(TABLE_PRODUCTIONS, $arr, array('id' => $id));
	}

	// production

	function deleteCustomer($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_USERS);
	}

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
		$this->db->select('t.*, i.*, u.name');
		$this->db->from(TABLE_RUNOFSHOWTITLES . ' as t');
		$this->db->join(TABLE_RUNOFSHOWITEMS . ' as i', 't.id = i.title_id', 'left');
		$this->db->join(TABLE_USERS . ' as u', 'u.id = i.leadTeamMember', 'left');
		$this->db->where('t.runOfShowId', $runId);
		return $this->db->get()->result_array();
	}

	public function deleteRunOfShowDetailsByRunId($runId)
	{
		// Delete items first to avoid foreign key constraint issues
		$this->db->where('runOfShowId', $runId);
		$this->db->delete(TABLE_RUNOFSHOWITEMS); // Assuming 'items' is the table where individual rows are stored

		// Now delete titles
		$this->db->where('runOfShowId', $runId);
		$this->db->delete(TABLE_RUNOFSHOWTITLES); // Assuming 'titles' is the table where title rows are stored
	}

	// copy run of show
	public function duplicateRunOfShowSchedule($oldRunOfShowId, $newRunOfShowId)
	{
		$this->db->select('*');
		$this->db->where('runOfShowId', $oldRunOfShowId);
		$titleQuery = $this->db->get(TABLE_RUNOFSHOWTITLES);
		$titleResult = $titleQuery->result_array();

		if (!empty($titleResult)) {
			$titleInsertData = [];
			foreach ($titleResult as $titleRow) {
				$titleInsertData[] = [
					'runOfShowId' => $newRunOfShowId,
					'title_name' => $titleRow['title_name']
				];
			}
			$this->db->insert_batch(TABLE_RUNOFSHOWTITLES, $titleInsertData);

			$newTitleMap = $this->db->insert_id();
			foreach ($titleResult as $index => $titleRow) {
				$titleResult[$index]['new_title_id'] = $newTitleMap + $index;
			}
		}

		$this->db->select('*');
		$this->db->where('runOfShowId', $oldRunOfShowId);
		$itemQuery = $this->db->get(TABLE_RUNOFSHOWITEMS);
		$itemResult = $itemQuery->result_array();

		if (!empty($itemResult) && !empty($titleResult)) {
			$itemInsertData = [];
			foreach ($itemResult as $itemRow) {
				$matchingTitle = array_filter($titleResult, function ($titleRow) use ($itemRow) {
					return $titleRow['id'] === $itemRow['title_id'];
				});
				$newTitleId = reset($matchingTitle)['new_title_id'] ?? null;

				if ($newTitleId) {
					$itemInsertData[] = [
						'runOfShowId' => $newRunOfShowId,
						'title_id' => $newTitleId,
						'item_name' => $itemRow['item_name'],
						'start_time' => $itemRow['start_time'],
						'duration' => $itemRow['duration'],
						'crew_member' => $itemRow['crew_member'],
						'leadTeamMember' => $itemRow['leadTeamMember'],
						'talent' => $itemRow['talent'],
						'location' => $itemRow['location'],
						'area_space' => $itemRow['area_space'],
						'details' => $itemRow['details'],
						'private_notes' => $itemRow['private_notes']
					];
				}
			}
			if (!empty($itemInsertData)) {
				$this->db->insert_batch(TABLE_RUNOFSHOWITEMS, $itemInsertData);
			}
		}
	}

	public function duplicateRunOfShowCrewTravel($oldRunOfShowId, $newRunOfShowId)
	{
		$this->db->select('*');
		$this->db->where('runOfShowId', $oldRunOfShowId);
		$query = $this->db->get(TABLE_RUNOFSHOWCREWTRAVEL);
		$result = $query->result_array();

		if (!empty($result)) {
			$insertData = [];
			foreach ($result as $row) {
				$insertData[] = [
					'runOfShowId' => $newRunOfShowId,
					'crewMemberId' => $row['crewMemberId'],
					'travelTypeTo' => $row['travelTypeTo'],
					'airlineTo' => $row['airlineTo'],
					'specifyTravelTo' => $row['specifyTravelTo'],
					'airportFromTo' => $row['airportFromTo'],
					'departureTimeTo' => $row['departureTimeTo'],
					'confirmationTo' => $row['confirmationTo'],
					'airportToTo' => $row['airportToTo'],
					'arrivalTimeTo' => $row['arrivalTimeTo'],
					'travelTypeFrom' => $row['travelTypeFrom'],
					'airlineFrom' => $row['airlineFrom'],
					'specifyTravelFrom' => $row['specifyTravelFrom'],
					'airportFromFrom' => $row['airportFromFrom'],
					'departureTimeFrom' => $row['departureTimeFrom'],
					'confirmationFrom' => $row['confirmationFrom'],
					'airportToFrom' => $row['airportToFrom'],
					'arrivalTimeFrom' => $row['arrivalTimeFrom'],
					'groundTransCo' => $row['groundTransCo'],
					'vehicleMake' => $row['vehicleMake'],
					'driverName' => $row['driverName'],
					'driverPhone' => $row['driverPhone'],
					'vehicleModel' => $row['vehicleModel'],
					'vehicleTag' => $row['vehicleTag'],
					'pickUpTime' => $row['pickUpTime'],
					'dropOffTime' => $row['dropOffTime'],
					'dropOffLocation' => $row['dropOffLocation'],
					'groundNotes' => $row['groundNotes'],
					'hotelName' => $row['hotelName'],
					'hotelStay' => $row['hotelStay'],
					'confirmationAccommodation' => $row['confirmationAccommodation'],
					'perDiem' => $row['perDiem'],
					'hotelAddress' => $row['hotelAddress'],
					'roomType' => $row['roomType'],
					'checkIn' => $row['checkIn'],
					'checkOut' => $row['checkOut'],
					'accommodationNote' => $row['accommodationNote']
				];
			}
			$this->db->insert_batch(TABLE_RUNOFSHOWCREWTRAVEL, $insertData);
		}
	}

	public function duplicateRunOfShowTalentCrew($oldRunOfShowId, $newRunOfShowId)
	{
		$this->db->select('*');
		$this->db->where('runOfShowId', $oldRunOfShowId);
		$query = $this->db->get(TABLE_RUNOFSHOWTALENTCREW);
		$result = $query->result_array();

		if (!empty($result)) {
			$insertData = [];
			foreach ($result as $row) {
				$insertData[] = [
					'runOfShowId' => $newRunOfShowId,
					'crewMemberId' => $row['crewMemberId'],
					'travelTypeTo' => $row['travelTypeTo'],
					'airlineTo' => $row['airlineTo'],
					'specifyTravelTo' => $row['specifyTravelTo'],
					'airportFromTo' => $row['airportFromTo'],
					'departureTimeTo' => $row['departureTimeTo'],
					'confirmationTo' => $row['confirmationTo'],
					'airportToTo' => $row['airportToTo'],
					'arrivalTimeTo' => $row['arrivalTimeTo'],
					'travelTypeFrom' => $row['travelTypeFrom'],
					'airlineFrom' => $row['airlineFrom'],
					'specifyTravelFrom' => $row['specifyTravelFrom'],
					'airportFromFrom' => $row['airportFromFrom'],
					'departureTimeFrom' => $row['departureTimeFrom'],
					'confirmationFrom' => $row['confirmationFrom'],
					'airportToFrom' => $row['airportToFrom'],
					'arrivalTimeFrom' => $row['arrivalTimeFrom'],
					'groundTransCo' => $row['groundTransCo'],
					'vehicleMake' => $row['vehicleMake'],
					'driverName' => $row['driverName'],
					'driverPhone' => $row['driverPhone'],
					'vehicleModel' => $row['vehicleModel'],
					'vehicleTag' => $row['vehicleTag'],
					'pickUpTime' => $row['pickUpTime'],
					'dropOffTime' => $row['dropOffTime'],
					'dropOffLocation' => $row['dropOffLocation'],
					'groundNotes' => $row['groundNotes'],
					'hotelName' => $row['hotelName'],
					'hotelStay' => $row['hotelStay'],
					'confirmationAccommodation' => $row['confirmationAccommodation'],
					'perDiem' => $row['perDiem'],
					'hotelAddress' => $row['hotelAddress'],
					'roomType' => $row['roomType'],
					'checkIn' => $row['checkIn'],
					'checkOut' => $row['checkOut'],
					'accommodationNote' => $row['accommodationNote']
				];
			}
			$this->db->insert_batch(TABLE_RUNOFSHOWTALENTCREW, $insertData);
		}
	}

	public function duplicateRunOfShowPoc($oldRunOfShowId, $newRunOfShowId)
	{
		$this->db->select('*');
		$this->db->where('runOfShowId', $oldRunOfShowId);
		$query = $this->db->get(TABLE_RUNOFSHOWPOC);
		$result = $query->result_array();

		if (!empty($result)) {
			$insertData = [];
			foreach ($result as $row) {
				$insertData[] = [
					'runOfShowId' => $newRunOfShowId,
					'name' => $row['name'],
					'title' => $row['title'],
					'phone' => $row['phone'],
					'email' => $row['email'],
					'assistantName' => $row['assistantName'],
					'assistantTitle' => $row['assistantTitle'],
					'assistantPhone' => $row['assistantPhone'],
					'assistantEmail' => $row['assistantEmail'],
					'backUpTitle' => $row['backUpTitle'],
					'backUpPhone' => $row['backUpPhone'],
					'backUpEmail' => $row['backUpEmail']
				];
			}
			$this->db->insert_batch(TABLE_RUNOFSHOWPOC, $insertData);
		}
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

	function deleteRunOfShowCrewTravelByRunOfShowId($id)
	{
		$this->db->where('runOfShowId', $id);
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
		$this->db->where('t.runOfShowId', $id);
		return $this->db->get()->result();
	}

	public function getRunOfShowCrewTravelById($id)
	{
		$this->db->select('t.*, i.firstName, i.lastName, r.productionId');
		$this->db->from(TABLE_RUNOFSHOWCREWTRAVEL . ' as t');
		$this->db->join(TABLE_RUNOFSHOW . ' as r', 'r.id = t.runOfShowId');
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
		$this->db->where('t.runOfShowId', $id);
		return $this->db->get()->result();
	}

	function saveRunOfShowTalentCrew($arr)
	{
		$this->db->insert(TABLE_RUNOFSHOWTALENTCREW, $arr);
	}

	public function getRunOfShowTalentCrewById($id)
	{
		$this->db->select('t.*, i.firstName, i.lastName, r.productionId');
		$this->db->from(TABLE_RUNOFSHOWTALENTCREW . ' as t');
		$this->db->join(TABLE_RUNOFSHOW . ' as r', 'r.id = t.runOfShowId');
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

	function deleteRunOfShowTalentCrewRunOfShowId($id)
	{
		$this->db->where('runOfShowId', $id);
		$this->db->delete(TABLE_RUNOFSHOWTALENTCREW);
	}

	// Run of Show POC
	public function getRunOfShowPocDetails($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_RUNOFSHOWPOC);
		$this->db->where('runOfShowId', $id);
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


	function deleteRunOfShowPocRunOfShowId($id)
	{
		$this->db->where('runOfShowId', $id);
		$this->db->delete(TABLE_RUNOFSHOWPOC);
	}

	// timed access link
	function saveTimedAccessLink($arr)
	{
		$this->db->insert(TABLE_TIMEDACCESSLINK, $arr);
		return $this->db->insert_id();
	}

	public function getTimedAccessLinkDetailsByRunOfShowId($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_TIMEDACCESSLINK);
		$this->db->where('runOfShowId', $id);
		return $this->db->get()->result();
	}


	function insertCrewTravel($arr)
	{
		$this->db->insert(TABLE_TIMEDACCESSLINKCREWTRAVEL, $arr);
	}

	function insertTalentTravel($arr)
	{
		$this->db->insert(TABLE_TIMEDACCESSLINKTALENTTRAVEL, $arr);
	}

	function insertPoc($arr)
	{
		$this->db->insert(TABLE_TIMEDACCESSLINKPOC, $arr);
	}

	public function getTimedAccessLinkCrewTravelDetailsByRunOfShowId($id)
	{
		$this->db->select('t.*, c.firstName, c.lastName');
		$this->db->from(TABLE_TIMEDACCESSLINKCREWTRAVEL . ' as t');
		$this->db->join(TABLE_CREWMEMBERS . ' as c', 't.crewTravelId = c.id');
		$this->db->where('t.runOfShowId', $id);
		return $this->db->get()->result();
	}

	public function getTimedAccessLinkTalentTravelDetailsByRunOfShowId($id)
	{
		$this->db->select('t.*, c.firstName, c.lastName');
		$this->db->from(TABLE_TIMEDACCESSLINKTALENTTRAVEL . ' as t');
		$this->db->join(TABLE_ENTERTAINER . ' as c', 't.talentTravelId = c.id');
		$this->db->where('t.runOfShowId', $id);
		return $this->db->get()->result();
	}

	public function getTimedAccessLinkPocDetailsByRunOfShowId($id)
	{
		$this->db->select('t.*, c.name, c.title');
		$this->db->from(TABLE_TIMEDACCESSLINKPOC . ' as t');
		$this->db->join(TABLE_RUNOFSHOWPOC . ' as c', 't.pocId = c.id');
		$this->db->where('t.runOfShowId', $id);
		return $this->db->get()->result();
	}

	function updateTimedAccessLinkById($arr, $id)
	{
		$this->db->update(TABLE_TIMEDACCESSLINK, $arr, array('id' => $id));
	}

	public function getTimedAccessLinkDetailsById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_TIMEDACCESSLINK);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	public function getTimedAccessLinkCrewTravelDetailsById($id)
	{
		$this->db->select('c.firstName, c.lastName, rc.*');
		$this->db->from(TABLE_TIMEDACCESSLINKCREWTRAVEL . ' as t');
		$this->db->join(TABLE_RUNOFSHOWCREWTRAVEL . ' as rc', 't.crewTravelId = rc.crewMemberId');
		$this->db->join(TABLE_CREWMEMBERS . ' as c', 't.crewTravelId = c.id');
		$this->db->where('t.timedAccessLinkId', $id);
		return $this->db->get()->result();
	}

	public function getTimedAccessLinkTalentTravelDetailsById($id)
	{
		$this->db->select('c.firstName, c.lastName, rc.*');
		$this->db->from(TABLE_TIMEDACCESSLINKTALENTTRAVEL . ' as t');
		$this->db->join(TABLE_RUNOFSHOWTALENTCREW . ' as rc', 't.talentTravelId = rc.crewMemberId');
		$this->db->join(TABLE_ENTERTAINER . ' as c', 't.talentTravelId = c.id');
		$this->db->where('t.timedAccessLinkId', $id);
		return $this->db->get()->result();
	}

	public function getTimedAccessLinkPocDetailsById($id)
	{
		$this->db->select('c.*');
		$this->db->from(TABLE_TIMEDACCESSLINKPOC . ' as t');
		$this->db->join(TABLE_RUNOFSHOWPOC . ' as c', 't.pocId = c.id');
		$this->db->where('t.timedAccessLinkId', $id);
		return $this->db->get()->result();
	}

	function deleteTimedAccessLinkExtend($id)
	{
		$this->db->delete(TABLE_TIMEDACCESSLINKCREWTRAVEL, array('timedAccessLinkId' => $id));
		$this->db->delete(TABLE_TIMEDACCESSLINKTALENTTRAVEL, array('timedAccessLinkId' => $id));
		$this->db->delete(TABLE_TIMEDACCESSLINKPOC, array('timedAccessLinkId' => $id));
	}

	function deleteTimedAccessLink($id)
	{
		$this->db->delete(TABLE_TIMEDACCESSLINK, array('id' => $id));
	}

	// project KPI

	function saveProject($arr)
	{
		$this->db->insert(TABLE_PROJECTS, $arr);
	}

	function getProjectById($id)
	{
		$this->db->select('r.*, p.title, p.eventMonth, p.eventYear, v.venueName, v.address, v.city, v.state, v.zip');
		$this->db->from(TABLE_PROJECTS . ' as r');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'r.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where('r.id', $id);
		return $this->db->get()->row();
	}

	function updateProject($arr, $id)
	{
		$this->db->update(TABLE_PROJECTS, $arr, array('id' => $id));
	}

	function deleteProject($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_PROJECTS);
	}

	// project overview
	function saveProjectOverview($arr)
	{
		$this->db->insert(TABLE_PROJECTOVERVIEW, $arr);
	}

	function getProjectOverviewByProjectId($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_PROJECTOVERVIEW);
		$this->db->where('projectId', $id);
		return $this->db->get()->row();
	}

	function updateProjectOverview($arr, $id)
	{
		$this->db->update(TABLE_PROJECTOVERVIEW, $arr, array('projectId' => $id));
	}

	function deleteProjectOverview($id)
	{
		$this->db->where('projectId', $id);
		$this->db->delete(TABLE_PROJECTOVERVIEW);
	}

	// project KPI
	public function getProjectKPITitleLastOkr($projectId)
	{
		$this->db->select('*');
		$this->db->from(TABLE_PROJECTKPITITLE);
		$this->db->where('projectId', $projectId);
		$this->db->order_by('id', 'desc');
		return $this->db->get()->row();
	}

	public function getProjectKPITitleById($id)
	{
		$this->db->select('p.*, u.name as responsible, u1.name as accountable, u2.name as consulted, u3.name as informed');
		$this->db->from(TABLE_PROJECTKPITITLE . ' as p');
		$this->db->join(TABLE_USERS . ' as u', 'p.responsibleId = u.id', 'left');
		$this->db->join(TABLE_USERS . ' as u1', 'p.accountableId = u1.id', 'left');
		$this->db->join(TABLE_USERS . ' as u2', 'p.consultedId = u2.id', 'left');
		$this->db->join(TABLE_USERS . ' as u3', 'p.informedId = u3.id', 'left');
		$this->db->where('p.id', $id);
		return $this->db->get()->row();
	}

	public function getProjectKPITitleByProjectId($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_PROJECTKPITITLE);
		$this->db->where('projectId', $id);
		return $this->db->get()->result();
	}

	public function getProjectKPIItemsByTitleId($titleId)
	{
		$this->db->select('*');
		$this->db->from(TABLE_PROJECTKPIITEM);
		$this->db->where('title_id', $titleId);
		return $this->db->get()->result();
	}

	public function getProjectKPIItemsById($id)
	{
		$this->db->select('i.*, to.okr as tOkr, to.productionPhase, to.timelineTrack, to.dueDate as tDueDate, u.name as responsible, u1.name as accountable, u2.name as consulted, u3.name as informed');
		$this->db->from(TABLE_PROJECTKPIITEM . ' as i');
		$this->db->join(TABLE_PROJECTKPITITLE . ' as to', 'i.title_id = to.id');
		$this->db->join(TABLE_USERS . ' as u', 'i.responsibleId = u.id', 'left');
		$this->db->join(TABLE_USERS . ' as u1', 'i.accountableId = u1.id', 'left');
		$this->db->join(TABLE_USERS . ' as u2', 'i.consultedId = u2.id', 'left');
		$this->db->join(TABLE_USERS . ' as u3', 'i.informedId = u3.id', 'left');
		$this->db->where('i.id', $id);
		return $this->db->get()->row();
	}

	function getProjectKpiDetails($projectId)
	{
		$this->db->select('t.id as tId, t.type as tType, t.okr as tOkr, t.productionPhase as tProductionPhase, t.timelineTrack as tTimelineTrack, t.timelineGoal as tTimelineGoal, 
			t.timelineAction as tTimelineAction, t.timelineView as tTimelineView, t.milestoneMark as tMilestoneMark, t.metrics as tMetrics, t.startDate as tStartDate, t.dueDate as tDueDate, 
			t.qtr as tQtr, t.status as tStatus, t.markedDate as tMarkedDate, uu.name as tResponsible, uu1.name as tAccountable, uu2.name as tConsulted, uu3.name as tInformed, t.xfnName as tXfnName, 
			t.xfnEmail as tXfnEmail, t.studioFloName as tStudioFloName, t.studioFloDirectory as tStudioFloDirectory,
			i.id as iId, i.title_id, i.type as iType, i.okr as iOkr, i.timelineGoal as iTimelineGoal, i.timelineAction as iTimelineAction, 
			i.timelineView as iTimelineView, i.milestoneMark as iMilestoneMark, i.metrics as iMetrics, i.startDate as iStartDate, i.dueDate as iDueDate, i.qtr as iQtr, i.status as iStatus, 
			i.markedDate as iMarkedDate, u.name as responsible, u1.name as accountable, u2.name as consulted, u3.name as informed, i.xfnName as iXfnName, i.xfnEmail as iXfnEmail, i.studioFloName as iStudioFloName, 
			i.studioFloDirectory as iStudioFloDirectory');
		$this->db->from(TABLE_PROJECTKPITITLE . ' as t');
		$this->db->join(TABLE_PROJECTKPIITEM . ' as i', 't.id = i.title_id', 'left');
		$this->db->join(TABLE_USERS . ' as u', 'i.responsibleId = u.id', 'left');
		$this->db->join(TABLE_USERS . ' as u1', 'i.accountableId = u1.id', 'left');
		$this->db->join(TABLE_USERS . ' as u2', 'i.consultedId = u2.id', 'left');
		$this->db->join(TABLE_USERS . ' as u3', 'i.informedId = u3.id', 'left');
		$this->db->join(TABLE_USERS . ' as uu', 't.responsibleId = uu.id', 'left');
		$this->db->join(TABLE_USERS . ' as uu1', 't.accountableId = uu1.id', 'left');
		$this->db->join(TABLE_USERS . ' as uu2', 't.consultedId = uu2.id', 'left');
		$this->db->join(TABLE_USERS . ' as uu3', 't.informedId = uu3.id', 'left');
		$this->db->where('t.projectId', $projectId);
		$this->db->order_by('t.okr', 'ASC');
		return $this->db->get()->result_array();
	}

	function saveProjectKpiTitle($arr)
	{
		$this->db->insert(TABLE_PROJECTKPITITLE, $arr);
	}

	function saveProjectKpiItem($arr)
	{
		$this->db->insert(TABLE_PROJECTKPIITEM, $arr);
	}

	function updateProjectKPITitleById($arr, $id)
	{
		$this->db->update(TABLE_PROJECTKPITITLE, $arr, array('id' => $id));
	}

	public function batchUpdateProjectKPITitleByIds($data, $ids)
	{
		// Validate input
		if (empty($data) || empty($ids) || !is_array($ids)) {
			return false; // Invalid input
		}
		// Build the query dynamically
		$this->db->where_in('id', $ids);
		return $this->db->update('project_kpi_titles', $data);
	}

	function updateProjectKPIItemById($arr, $id)
	{
		$this->db->update(TABLE_PROJECTKPIITEM, $arr, array('id' => $id));
	}

	function deleteProjectKpiTitle($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_PROJECTKPITITLE);
		$this->db->where('title_id', $id);
		$this->db->delete(TABLE_PROJECTKPIITEM);
	}

	function deleteProjectKpiItem($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_PROJECTKPIITEM);
	}

}
