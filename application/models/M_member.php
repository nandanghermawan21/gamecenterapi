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

	/**
	 * @OA\Property()
	 * @var string
	 */
	public $username;
	public function usernameField(): string
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


	/**
	 * @OA\Property()
	 * @var string
	 */
	public $name;
	public function nameField(): string
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

	/**
	 * @OA\Property()
	 * @var string
	 */
	public $phone;
	public function phoneField(): string
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

	/**
	 * @OA\Property()
	 * @var date
	 */
	public $dob;
	public function dobField(): string
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

	/**
	 * @OA\Property()
	 * @var int
	 */
	public $silverTicket;
	public function silverTicketField(): string
	{
		return "silver_ticket";
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

		if (isset($json[$$this->id])) {
			$data->id = $json[$$this->id];
		}
		if (isset($json[$$this->username])) {
			$data->username = $json[$$this->username];
		}
		if (isset($json[$$this->password])) {
			$data->password = $json[$$this->password];
		}
		if (isset($json[$$this->name])) {
			$data->name = $json[$$this->name];
		}
		if (isset($json[$$this->address])) {
			$data->address = $json[$$this->address];
		}
		if (isset($json[$$this->phone])) {
			$data->phone = $json[$$this->phone];
		}
		if (isset($json[$$this->email])) {
			$data->email = $json[$$this->email];
		}
		if (isset($json[$$this->dob])) {
			$data->dob = $json[$$this->dob];
		}
		if (isset($json[$$this->point])) {
			$data->point = $json[$$this->point];
		}
		if (isset($json[$$this->silverTicket])) {
			$data->silverTicket = $json[$$this->silverTicket];
		}
		if (isset($json[$$this->goldTicketFied])) {
			$data->goldTicket = $json[$$this->goldTicketField];
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
