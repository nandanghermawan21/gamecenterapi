<?php if (!defined('BASEPATH')) exit('No direct script allowed');

/**
 * @OA\Schema(schema="voucher")
 */

class M_voucher extends CI_Model
{
	public function tableName(): string
	{
		return "m_voucher";
	}
	/**
	 * @OA\Property()
	 * @var string
	 */
	public $id;
	public function idField(): string
	{
		return "id";
	}
	public function idjsonKey(): string
	{
		return "id";
	}

	/**
	 * @OA\Property()
	 * @var int
	 */
	public $used;
	public function usedField(): String
	{
		return "used";
	}
	public function usedJsonKey(): String
	{
		return "used";
	}

	/**
	 * @OA\Property()
	 * @var int
	 */
	public $count;
	public function countField(): String
	{
		return "count";
	}
	public function countJsonKey(): String
	{
		return "count";
	}

	/**
	 * @OA\Property()
	 * @var int
	 */
	public $point;
	public function pointField(): String
	{
		return "point";
	}
	public function pointJsonKey(): String
	{
		return "point";
	}

	/**
	 * @OA\Property()
	 * @var int
	 */
	public $silverTicket;
	public function silverTicketField(): String
	{
		return "silver_ticket";
	}
	public function silverTicketJsonKey(): String
	{
		return "silverTicket";
	}

	/**
	 * @OA\Property()
	 * @var int
	 */
	public $goldTicket;
	public function goldTicketField(): String
	{
		return "gold_ticket";
	}
	public function goldTicketJsonKey(): String
	{
		return "goldTicket";
	}


	/**
	 * @OA\Property()
	 * @var string
	 */
	public $startDate;
	public function startDateField(): string
	{
		return "start_date";
	}
	public function startDateJsonKey(): string
	{
		return "startDate";
	}

	/**
	 * @OA\Property()
	 * @var string
	 */
	public $endDate;
	public function endDateField(): string
	{
		return "end_date";
	}
	public function endDateJsonKey(): string
	{
		return "endDate";
	}

	/**
	 * @OA\Property()
	 * @var string
	 */
	public $createDate;
	public function createDateField(): string
	{
		return "create_date";
	}
	public function createDateJsonKey(): string
	{
		return "createDate";
	}

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->helper('string');
	}

	function fromRow($row): M_voucher
	{
		$this->id = $row->id;
		$this->count = $row->count;
		$this->used = $row->used;
		$this->point = $row->point;
		$this->silverTicket = $row->silver_ticket;
		$this->goldTicket = $row->gold_ticket;
		$this->startDate = $row->start_date;
		$this->endDate = $row->end_date;
		$this->createDate = $row->create_date;

		return $this;
	}

	function fromJson($json): M_voucher
	{
		if (isset($json[$this->idjsonKey()])) {
			$this->id = $json[$this->idjsonKey()];
		}
		if (isset($json[$this->countJsonKey()])) {
			$this->count = $json[$this->countJsonKey()];
		}
		if (isset($json[$this->usedJsonKey()])) {
			$this->used = $json[$this->usedJsonKey()];
		}
		if (isset($json[$this->pointJsonKey()])) {
			$this->point = $json[$this->pointJsonKey()];
		}
		if (isset($json[$this->silverTicketJsonKey()])) {
			$this->silverTicket = $json[$this->silverTicketJsonKey()];
		}
		if (isset($json[$this->goldTicketJsonKey()])) {
			$this->goldTicket = $json[$this->goldTicketJsonKey()];
		}
		if (isset($json[$this->startDateJsonKey()])) {
			$this->startDate = $json[$this->startDateJsonKey()];
		}
		if (isset($json[$this->endDateJsonKey()])) {
			$this->endDate = $json[$this->endDateJsonKey()];
		}
		if (isset($json[$this->createDateJsonKey()])) {
			$this->createDate = $json[$this->createDateJsonKey()];
		}
		return $this;
	}

	public function fromId(String $id): M_voucher
	{
		$data = $this->db->get_where($this->tableName(), array('id' => $id));

		return $this->fromRow($data->result()[0]);
	}

	function toArray(): array
	{
		$data = array(
			$this->idField() => $this->id,
			$this->countField() => $this->count,
			$this->usedField() => $this->used,
			$this->pointField() => $this->point,
			$this->silverTicketField() => $this->silverTicket,
			$this->goldTicketField() => $this->goldTicket,
			$this->startDateField() => $this->startDate,
			$this->endDateField() => $this->endDate,
			$this->createDateField() => $this->createDate,
		);

		return $data;
	}

	function add(String $prefix = "", String $sufix = ""): M_voucher
	{
		try {
			//generate key
			$this->id = random_string('numeric',  12, $prefix, $sufix);

			//chek if key exist
			if (count($this->db->get_where($this->tableName(), array('id' => $this->id))->result()) >= 1) {
				$this->add($prefix, $sufix);
			}

			$this->db->insert($this->tableName(), $this->toArray());

			$data = $this->db->get_where($this->tableName(), array('id' => $this->id));

			return $this->fromRow($data->result()[0]);
		} catch (Exception $e) {
			throw $e;
		}
	}

	function addBatch(String $prefix = "", String $sufix = "", int $count = 1): array
	{
		$data = [];

		for ($i = 1; $i <= $count; $i++) {
			array_push($data, $this->add($prefix, $sufix));
		}

		return $data;
	}

	public function get(String $id = null, String $searchKey = null, int $limit = 0, int $skip = 10): array
	{
		$this->db->select('*');
		$this->db->from($this->tableName());

		if ($id != null && $id != "")
			$this->db->where($this->idField(), $id);

		if ($searchKey != null && $searchKey != "") {
			$this->db->or_like($this->idField(), $searchKey);
		}

		$this->db->limit($limit, $skip);

		$query = $this->db->get();

		$result = [];
		foreach ($query->result() as $row) {
			$member = new M_voucher();
			$result[] = $member->fromRow($row);
		}

		return $result;
	}

	function getById(String $id): M_voucher
	{
		$this->id = $id;
		$data = $this->db->get_where($this->tableName(), array('id' => $this->id))->result();

		if (count($data) == 1) {
			return $this->fromRow($data[0]);
		} else {
			$this->id = "";
			return $this;
		}
	}

	function getData(): M_voucher
	{
		return $this->getById($this->id);
	}

	function useVoucher(String $id)
	{
		$this->getById($id);
		if ($this == "") {
			throw new Exception("voucher not found");
		}

		if ($this->used >= $this->count) {
			throw new Exception("voucher is not valid");
		}

		$this->db->set($this->usedField(), ($this->used ?? 0) + 1);
		$this->db->where($this->idField(), $this->id);
		$this->db->update($this->tableName());

		return $this->getData();
	}
}
