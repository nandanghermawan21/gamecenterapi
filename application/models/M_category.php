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
        $data->iconUrl = $row->icon_url;

        return $data;
    }

    function toRow()
    {
        $data = new stdClass();
        $data->id = $this->id;
        $data->name = $this->name;
        $data->icon_url = $this->iconUrl;

        return $data;
    }

    function fromJson($json)
    {
        $data = new M_category();
        $data->id = $json["id"];
        $data->name = $json["name"];
        $data->iconUrl = $json["iconUrl"];

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
        $this->db->insert('m_category', $category->toRow());

        $data = $this->db->get_where('m_category', array('id' => $category->id));

        return $this->fromRow($data->result()[0]);
    }

    function remove($id)
    {
        $data = array(
            'is_deleted' => 1,
        );

        $this->db->where('id', $id);
        $this->db->update('m_category', $data);

        $data = $this->db->get_where('m_category', array('id' => $id));

        return $this->fromRow($data->result()[0]);
    }

    function update($id, \M_category $category)
    {
        $data = array(
            'name' => $category->name,
            'iconUrl' => $category->iconUrl,
        );

        $this->db->where('id', $id);
        $this->db->update('m_category', $data);

        $data = $this->db->get_where('m_category', array('id' => $id));

        return $this->fromRow($data->result()[0]);
    }
}
