<?php if (!defined('BASEPATH')) exit('No direct script allowed');

/**
 * @OA\Schema(schema="member")
 */
class M_member extends CI_Model
{
	public function tableName(): string
	{
		return "m_member";
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
	 * @var string
	 */
	public $username;
	public function usernameField(): string
	{
		return "username";
	}
	public function usernameJsonKey(): string
	{
		return "username";
	}

	/**
	 * @OA\Property()
	 * @var string
	 */
	public $password;
	public function passwordField(): string
	{
		return "password";
	}
	public function passwordJsonKey(): string
	{
		return "password";
	}


	/**
	 * @OA\Property()
	 * @var string
	 */
	public $name;
	public function nameField(): string
	{
		return "name";
	}
	public function nameJsonKey(): string
	{
		return "name";
	}

	/**
	 * @OA\Property()
	 * @var string
	 */
	public $address;
	public function addressField(): string
	{
		return "address";
	}
	public function addressJsonKey(): string
	{
		return "address";
	}

	/**
	 * @OA\Property()
	 * @var string
	 */
	public $phone;
	public function phoneField(): string
	{
		return "phone";
	}
	public function phoneJsonKey(): string
	{
		return "phone";
	}

	/**
	 * @OA\Property()
	 * @var string
	 */
	public $email;
	public function emailField(): string
	{
		return "email";
	}
	public function emailJsonKey(): string
	{
		return "email";
	}

	/**
	 * @OA\Property()
	 * @var string
	 */
	public $imageId;
	public function imageIdField(): string
	{
		return "image_id";
	}
	public function imageIdJsonKey(): string
	{
		return "imageId";
	}

	/**
	 * @OA\Property()
	 * @var date
	 */
	public $dob;
	public function dobField(): string
	{
		return "dob";
	}
	public function dobJsonKey(): string
	{
		return "dob";
	}

	/**
	 * @OA\Property()
	 * @var int
	 */
	public $point;
	public function pointField(): string
	{
		return "point";
	}
	public function pointJsonKey(): string
	{
		return "point";
	}

	/**
	 * @OA\Property()
	 * @var int
	 */
	public $silverTicket;
	public function silverTicketField(): string
	{
		return "silver_ticket";
	}
	public function silverTicketJsonKey(): string
	{
		return "silverTicket";
	}

	/**
	 * @OA\Property()
	 * @var int
	 */
	public $goldTicket;
	public function goldTicketField(): string
	{
		return "gold_ticket";
	}
	public function goldTicketJsonKey(): string
	{
		return "goldTicket";
	}

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->helper('string');
	}

	function fromRow($row): M_member
	{
		$this->id = $row->id;
		$this->username = $row->username;
		$this->password = $row->password;
		$this->name = $row->name;
		$this->address = $row->address;
		$this->phone = $row->phone;
		$this->email = $row->email;
		$this->imageId = $row->image_id;
		$this->dob = $row->dob;
		$this->point = $row->point;
		$this->silverTicket = $row->silver_ticket;
		$this->goldTicket = $row->gold_ticket;

		return $this;
	}

	function fromJson($json): M_member
	{
		if (isset($json[$this->idjsonKey()])) {
			$this->id = $json[$this->idjsonKey()];
		}
		if (isset($json[$this->usernameJsonKey()])) {
			$this->username = $json[$this->usernameJsonKey()];
		}
		if (isset($json[$this->passwordJsonKey()])) {
			$this->password = $json[$this->passwordJsonKey()];
		}
		if (isset($json[$this->nameJsonKey()])) {
			$this->name = $json[$this->nameJsonKey()];
		}
		if (isset($json[$this->addressJsonKey()])) {
			$this->address = $json[$this->addressJsonKey()];
		}
		if (isset($json[$this->phoneJsonKey()])) {
			$this->phone = $json[$this->phoneJsonKey()];
		}
		if (isset($json[$this->emailJsonKey()])) {
			$this->email = $json[$this->emailJsonKey()];
		}
		if (isset($json[$this->imageIdJsonKey()])) {
			$this->imageId = $json[$this->imageIdJsonKey()()];
		}
		if (isset($json[$this->dobJsonKey()])) {
			$this->dob = $json[$this->dobJsonKey()];
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

		return $this;
	}

	function toArray(): array
	{
		$data = array(
			$this->idField() => $this->id,
			$this->usernameField() => $this->username,
			$this->passwordField() => $this->password,
			$this->nameField() => $this->name,
			$this->addressField() => $this->address,
			$this->phoneField() => $this->phone,
			$this->emailField() => $this->email,
			$this->imageIdField() => $this->imageId,
			$this->dobField() => $this->dob,
			$this->pointField() => $this->point,
			$this->silverTicketField() => $this->silverTicket,
			$this->goldTicketField() => $this->goldTicket,
		);

		return $data;
	}


	function add(): M_member
	{
		try {
			//generate key
			$this->id = random_string('numeric', 12);
			$this->password = sha1($this->password . "|" . $this->id);

			$this->db->insert($this->tableName(), $this->toArray());

			$data = $this->db->get_where($this->tableName(), array('id' => $this->id));

			return $this->fromRow($data->result()[0]);
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function get(String $id = null, String $searchKey = null, int $skip = 0, int $limit = 10): array
	{
		$this->db->select('*');
		$this->db->from($this->tableName());

		if ($id != null && $id != "")
			$this->db->where($this->idField(), $id);

		if ($searchKey != null && $searchKey != "") {
			$this->db->like($this->usernameField(), $searchKey);
			$this->db->or_like($this->phoneField(), $searchKey);
			$this->db->or_like($this->emailField(), $searchKey);
			$this->db->or_like($this->phoneField(), $searchKey);
		}

		$skip = $skip == "" || $skip == null ? 0 : $skip;
		$limit = $limit == "" || $limit == null ? 0 : $skip;

		$this->db->limit($limit, $skip);

		$query = $this->db->get();

		$result = [];
		foreach ($query->result() as $row) {
			$result[] = $this->fromRow($row);
		}

		return $result;
	}
}
