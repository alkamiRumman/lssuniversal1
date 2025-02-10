<?php

class Vendor_model extends CI_Model
{
	function __construct()
	{
	}

	function totalInvoices()
	{
		$this->db->select('vv.*');
		$this->db->from(TABLE_VENDORINVOICE . ' as vv');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'vv.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where(array('vv.vendorId' => getSession()->id));
		return $this->db->get()->num_rows();
	}

	function totalPaidInvoices()
	{
		$this->db->select('vv.*');
		$this->db->from(TABLE_VENDORINVOICE . ' as vv');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'vv.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where(array('vv.status' => 'Paid', 'vv.vendorId' => getSession()->id));
		return $this->db->get()->num_rows();
	}

	function totalUnpaidInvoices()
	{
		$this->db->select('vv.*');
		$this->db->from(TABLE_VENDORINVOICE . ' as vv');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'vv.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where(array('vv.status' => 'Unpaid', 'vv.vendorId' => getSession()->id));
		return $this->db->get()->num_rows();
	}

	function totalRejectedInvoices()
	{
		$this->db->select('vv.*');
		$this->db->from(TABLE_VENDORINVOICE . ' as vv');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'vv.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where(array('vv.status' => 'Rejected', 'vv.vendorId' => getSession()->id));
		return $this->db->get()->num_rows();
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

	function getLastVendorInvoiceIdByToday()
	{
		$this->db->select('*');
		$this->db->from(TABLE_VENDORINVOICE);
		$this->db->where('submissionDate', date('Y-m-d'));
		$this->db->order_by('id', 'DESC');
		return $this->db->get()->row();
	}

	function saveVendorInvoiceDetails($arr)
	{
		$this->db->insert(TABLE_VENDORINVOICEDETAILS, $arr);
	}

	function getVendorInvoiceById($id)
	{
		$this->db->select('v.*, u.name, u.phone, u.username, u.businessName, u.ein, u.businessAddress, u.city, u.state,
		 	p.title, p.startDate, p.startTime, p.endDate, p.endTime, vv.venueName');
		$this->db->from(TABLE_VENDORINVOICE . ' as v');
		$this->db->join(TABLE_USERS . ' as u', 'v.vendorId = u.id');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'v.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as vv', 'p.venueId = vv.id');
		$this->db->where('v.id', $id);
		return $this->db->get()->row();
	}

	function getTotalAdminCustomerStatus()
	{
		$this->db->select('v.*');
		$this->db->from(TABLE_VENDORINVOICE . ' as v');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'v.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as vv', 'p.venueId = vv.id');
		$this->db->where('adminCustomerStatus', 1);
		$this->db->where('vendorId', getSession()->id);
		return $this->db->get()->num_rows();
	}

	function saveVendorInvoice($arr)
	{
		$this->db->insert(TABLE_VENDORINVOICE, $arr);
	}

	function getVendorDetailsInvoiceById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_VENDORINVOICEDETAILS);
		$this->db->where('vendorInvoiceId', $id);
		return $this->db->get()->result();
	}

	function updateVendorInvoice($arr, $id)
	{
		$this->db->update(TABLE_VENDORINVOICE, $arr, array('id' => $id));
	}

	function update($arr, $id)
	{
		$this->db->update(TABLE_USERS, $arr, array('id' => $id));
	}

	function deleteVendorInvoiceDetailsByInvoiceId($id)
	{
		$this->db->where('vendorInvoiceId', $id);
		$this->db->delete(TABLE_VENDORINVOICEDETAILS);
	}
}
