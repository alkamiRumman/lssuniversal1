<?php

class Site_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function getUser($username)
	{
		$this->db->select('*');
		$this->db->from(TABLE_USERS);
		$this->db->where(array('username' => $username, 'deleted' => 0));
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->row();
		}
		return false;
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

	function saveUser($arr)
	{
		$this->db->insert(TABLE_USERS, $arr);
	}

	function update($arr, $id)
	{
		$this->db->update(TABLE_USERS, $arr, array('id' => $id));
	}

	//timed access link

	public function getTimedAccessLinkDetailsById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_TIMEDACCESSLINK);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	function getRunOfShowById($id)
	{
		$this->db->select('r.*, p.title, p.startDate, p.startTime, p.endDate, v.venueName, v.address, v.city, v.state, v.zip');
		$this->db->from(TABLE_RUNOFSHOW . ' as r');
		$this->db->join(TABLE_PRODUCTIONS . ' as p', 'r.productionId = p.id');
		$this->db->join(TABLE_VENUE . ' as v', 'p.venueId = v.id');
		$this->db->where('r.id', $id);
		return $this->db->get()->row();
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
}
