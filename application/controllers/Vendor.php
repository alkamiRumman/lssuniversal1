<?php

/**
 * @property Vendor_model $vendor
 */
class Vendor extends MY_Controller
{
	public $path = '/vendor';

	function __construct()
	{
		parent::__construct();
		$this->ifNotLogin();
		$this->ifNotVendor();
		$this->load->model('Vendor_model', 'vendor');
	}

	function index()
	{
		$this->data['title'] = 'Dashboard';
		$this->data['totalInvoices'] = $this->vendor->totalInvoices();
		$this->data['totalPaidInvoices'] = $this->vendor->totalPaidInvoices();
		$this->data['totalUnpaidInvoices'] = $this->vendor->totalUnpaidInvoices();
		$this->data['totalRejectedInvoices'] = $this->vendor->totalRejectedInvoices();
		$this->makeView('/index');
	}

	function showDashboard()
	{
		$this->popupView('/showDashboard');
	}

	function fetch_email()
	{
		$email = $this->input->post('email');
		if ($email) {
			if ($this->vendor->fetch_email($email) == true) {
				echo true;
			} else {
				echo false;
			}
		}
	}

	function updateProfile()
	{
		$this->data['title'] = 'Update Profile';
		$this->data['data'] = getSession();
		$this->makeView('/updateProfile');
	}

	function update()
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
		$arr['bankName'] = $this->input->post('bankName');
		$arr['bankAddress'] = $this->input->post('bankAddress');
		$arr['bankCity'] = $this->input->post('bankCity');
		$arr['bankState'] = $this->input->post('bankState');
		$arr['bankZip'] = $this->input->post('bankZip');
		$arr['accountName'] = $this->input->post('accountName');
		$arr['abaRouting'] = $this->input->post('abaRouting');
		$arr['accountNumber'] = $this->input->post('accountNumber');
		$arr['accountType'] = $this->input->post('accountType');
		$arr['profilePicture'] = getSession()->profilePicture;
		$arr['createAt'] = getSession()->createAt;
		$arr['id'] = getSession()->id;

		$config['upload_path'] = './images/' . getSession()->id . '/w9Form';
		$config['allowed_types'] = 'pdf';
		$config['overwrite'] = true;

		if (!is_dir('images')) {
			mkdir('./images', 0777, true);
		}
		if (!is_dir('images/' . getSession()->id)) {
			mkdir('./images/' . getSession()->id, 0777, true);
		}
		if (!is_dir('images/' . getSession()->id . '/w9Form')) {
			mkdir('./images/' . getSession()->id . '/w9Form', 0777, true);
		}
		$this->load->library('upload', $config);
		if (!empty($_FILES['w9Form']['name'])) {
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('w9Form')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('danger', $error);
				redirect('vendor/updateProfile');
			}
			$w9Form = $this->upload->data('file_name');
			$arr['w9Form'] = $w9Form;
		}

		$this->vendor->update($arr, getSession()->id);
		unset($arr["password"]);
		$this->session->set_userdata("user", (object)$arr);
		$this->session->set_flashdata('success', 'Profile Updated Successfully.');
		redirect('vendor/updateProfile');

	}

	function vendorInvoice()
	{
		$this->data['title'] = 'Vendor Invoice';
		$this->data['totalAdminStatus'] = $this->vendor->getTotalAdminCustomerStatus();
		$this->makeView('/vendorInvoice');
	}

	function getVendorInvoice()
	{
		$this->datatables->select('v.id as id, v.id, p.title, v.adminCustomerStatus, v.invoiceNumber, v.submissionDate, v.dueDate, v.net, v.invoiceAmount, v.msa, v.status, v.createAt, v.updateAt');
		$this->datatables->from(TABLE_VENDORINVOICE . ' as v');
		$this->datatables->join(TABLE_PRODUCTIONS . ' as p', 'v.productionId = p.id');
		$this->datatables->join(TABLE_VENUE . ' as vv', 'p.venueId = vv.id');
		$this->datatables->where(array('v.vendorId' => getSession()->id));
		$this->datatables->order_by('id', 'desc');
		$this->datatables->generate();
	}

	function vendorInvoiceMarkRead($id)
	{
		$arr['adminCustomerStatus'] = 0;
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->vendor->updateVendorInvoice($arr, $id);
		$this->session->set_flashdata('success', 'Vendor Invoice Marked as Read Successfully.');
		redirect('vendor/vendorInvoice');
	}

	function addVendorInvoice()
	{
		$this->data['title'] = 'Submit Invoice';
		$this->makeView('/addVendorInvoice');
	}


	function getProductionSearch()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response = $this->vendor->getProductionSearch($searchTerm);
		echo json_encode($response);
	}


	function saveVendorInvoice()
	{
//		return dnp($_POST);
		$id = 1;
		if ($this->vendor->getLastVendorInvoiceIdByToday()) {
			$id = $this->vendor->getLastVendorInvoiceIdByToday()->id + 1;
		}
		$vendorId = $arr['vendorId'] = getSession()->id;
		$productionId = $arr['productionId'] = $this->input->post('productionId');
		$arr['invoiceNumber'] = date('Ymd') . '-' . str_pad($id, 4, '0', STR_PAD_LEFT);
		$arr['submissionDate'] = date('Y-m-d');
		$arr['dueDate'] = date('Y-m-d', strtotime('+90 days'));
		$arr['net'] = 90;
		$arr['invoiceAmount'] = $this->input->post('invoiceAmount');
		$arr['vendorNotes'] = $this->input->post('vendorNotes');
		$arr['status'] = 'Unpaid';
		$arr['adminCustomerStatus'] = 0;
		$arr['vendorStatus'] = 1;
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
				redirect('vendor/vendorInvoice');
			}
			$file = $this->upload->data('file_name');
			$arr['msa'] = $file;
		}
//		return dnp($arr);
		$this->vendor->saveVendorInvoice($arr);
		$invoiceId = $this->db->insert_id();
		for ($i = 0; $i < count($this->input->post('description')); $i++) {
			$ar['vendorInvoiceId'] = $invoiceId;
			$ar['description'] = $this->input->post('description')[$i];
			$ar['qty'] = $this->input->post('qty')[$i];
			$ar['price'] = $this->input->post('price')[$i];
			$ar['total'] = $this->input->post('total')[$i];
			$this->vendor->saveVendorInvoiceDetails($ar);
		}
		$this->session->set_flashdata('success', 'Vendor Invoice Added Successfully.');
		redirect('vendor/vendorInvoice');
	}

	function viewVendorInvoice($id)
	{
		$this->data['data'] = $this->vendor->getVendorInvoiceById($id);
		$this->data['details'] = $this->vendor->getVendordetailsInvoiceById($id);
		$this->popupView('/viewVendorInvoice');
	}

	function viewVendorInvoiceMSA($id)
	{
		$this->data['data'] = $this->vendor->getVendorInvoiceById($id);
		$this->popupView('/viewVendorInvoiceMSA');
	}

	function viewVendorInvoiceW9Form($id)
	{
		$this->data['data'] = $this->vendor->getVendorInvoiceById($id);
		$this->popupView('/viewVendorInvoiceW9Form');
	}

	function updateVendorInvoiceStatus()
	{
		$id = $this->input->post('id');
		$arr['status'] = $this->input->post('status');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$arr['adminCustomerStatus'] = 0;
		$arr['vendorStatus'] = 1;
		$this->vendor->updateVendorInvoice($arr, $id);
		echo json_encode(array('status' => 'success'));
	}

	function viewRejectedReason($id)
	{
		$this->data['data'] = $this->vendor->getVendorInvoiceById($id);
		$this->popupView('/viewRejectedReason');
	}

	function updateVendorInvoice($id)
	{
//		return dnp($_POST);
		$vendorId = $arr['vendorId'] = getSession()->id;
		$productionId = $arr['productionId'] = $this->input->post('productionId');
		$arr['invoiceAmount'] = $this->input->post('invoiceAmount');
		$arr['vendorNotes'] = $this->input->post('vendorNotes');
		$arr['status'] = 'Unpaid';
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$arr['adminCustomerStatus'] = 0;
		$arr['vendorStatus'] = 1;

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
				redirect('vendor/vendorInvoice');
			}
			$file = $this->upload->data('file_name');
			$arr['msa'] = $file;
		}
		$this->vendor->updateVendorInvoice($arr, $id);
		$this->vendor->deleteVendorInvoiceDetailsByInvoiceId($id);
		for ($i = 0; $i < count($this->input->post('description')); $i++) {
			$ar['vendorInvoiceId'] = $id;
			$ar['description'] = $this->input->post('description')[$i];
			$ar['qty'] = $this->input->post('qty')[$i];
			$ar['price'] = $this->input->post('price')[$i];
			$ar['total'] = $this->input->post('total')[$i];
			$this->vendor->saveVendorInvoiceDetails($ar);
		}
		$this->session->set_flashdata('success', 'Vendor Invoice Update Successfully.');
		redirect('vendor/vendorInvoice');
	}

	function editVendorInvoice($id)
	{
		$this->data['data'] = $this->vendor->getVendorInvoiceById($id);
		$this->data['details'] = $this->vendor->getVendordetailsInvoiceById($id);
		$this->popupView('/editVendorInvoice');
	}

}
