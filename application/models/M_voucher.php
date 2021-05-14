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
	public $count;
	public function countField(): int
	{
		return "count";
	}
	public function countJsonKey(): int
	{
		return "count";
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
			$this->startDateField() => $this->startDate,
			$this->endDateField() => $this->endDate,
			$this->createDateField() => $this->createDate,
		);

		return $data;
	}

	function add(): M_voucher
	{
		try {
			//generate key
			$this->id = random_string('numeric', 16);

			$this->db->insert($this->tableName(), $this->toArray());

			$data = $this->db->get_where($this->tableName(), array('id' => $this->id));

			return $this->fromRow($data->result()[0]);
		} catch (Exception $e) {
			throw $e;
		}
	}

	function addBatch(int $count): array
	{
		$data = [];

		for ($i = 1; $i <= $count; $i++) {
			array_push($data, $this->add());
		}

		return $data;
	}
}
