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
	 * @var int
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
		$data = new M_member();
		$data->id = $row->id;
		$data->username = $row->username;
		$data->password = $row->password;
		$data->name = $row->name;
		$data->address = $row->address;
		$data->phone = $row->phone;
		$data->email = $row->email;
		$data->dob = $row->dob;
		$data->point = $row->point;
		$data->silverTicket = $row->silver_ticket;
		$data->goldTicket = $row->gold_ticket;

		return $data;
	}

	function fromJson($json): M_member
	{
		$data = new M_member();

		if (isset($json[$this->idjsonKey()])) {
			$data->id = $json[$this->idjsonKey()];
		}
		if (isset($json[$this->usernameJsonKey()])) {
			$data->username = $json[$this->usernameJsonKey()];
		}
		if (isset($json[$this->passwordJsonKey()])) {
			$data->password = $json[$this->passwordJsonKey()];
		}
		if (isset($json[$this->nameJsonKey()])) {
			$data->name = $json[$this->nameJsonKey()];
		}
		if (isset($json[$this->addressJsonKey()])) {
			$data->address = $json[$this->addressJsonKey()];
		}
		if (isset($json[$this->phoneJsonKey()])) {
			$data->phone = $json[$this->phoneJsonKey()];
		}
		if (isset($json[$this->email])) {
			$data->email = $json[$this->emailJsonKey()];
		}
		if (isset($json[$this->dob])) {
			$data->dob = $json[$this->dobJsonKey()];
		}
		if (isset($json[$this->point])) {
			$data->point = $json[$this->pointJsonKey()];
		}
		if (isset($json[$this->silverTicketJsonKey()])) {
			$data->silverTicket = $json[$this->silverTicketJsonKey()];
		}
		if (isset($json[$this->goldTicketJsonKey()])) {
			$data->goldTicket = $json[$this->goldTicketJsonKey()];
		}

		return $data;
	}

	function toArray(): array
	{
		$data = array(
			'id' => $this->id,
			'username' => $this->username,
			'password' => $this->password,
			'name' => $this->name,
			'address' => $this->address,
			'phone' => $this->phone,
			'email' => $this->email,
			'dob' => $this->dob,
			'point' => $this->point,
			'silver_ticket' => $this->silverTicket,
			'gold_ticket' => $this->goldTicket,
		);

		return $data;
	}


	function insert_entry(M_member $member): M_member
	{
		try {
			//generate key
			$this->id = random_string('alnum', 10);

			$this->db->insert($this->tableName(), $this->toArray());

			$data = $this->db->get_where($this->tableName(), array('id' => $this->id));

			return $this->fromRow($data->result()[0]);
		} catch (Exception $e) {
			throw $e;
		}
	}
}
