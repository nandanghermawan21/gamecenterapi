<?php if (!defined('BASEPATH')) exit('No direct script allowed');


/**
 * @OA\Schema(schema="category")
 */
class M_category extends CI_Model
{
    /**
     * @OA\Property()
     * @var string
     */
    public $id;

    /**
     * @OA\Property()
     * @var string
     */
    public $name;

    /**
     * @OA\Property()
     * @var string
     */
    public $iconUrl;

    function fromRow($row)
    {
        $data = new M_category();
        $data->id = $row->id;
        $data->name = $row->name;

        return $data;
    }

    function getAll()
    {
        $query = $this->db->get('m_category');

        $result = [];
        foreach ($query->result() as $row) {
            array_push($result, $this->fromRow($row));
        }

        return $result;
    }

    function add($category)
    {
        $this->db->insert('m_category', $category);

        $data = $this->db->get_where('id', array('id' => $$category->id));

        return $this->fromRow($data[0]);
    }
}
