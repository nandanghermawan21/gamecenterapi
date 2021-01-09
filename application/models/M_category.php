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

    function getAll()
    {
        $query = $this->db->get('m_category');

        $result = [];
        foreach ($query->result() as $row) {
            $data = new M_category();
            $data->id = $row->id;
            $data->name = $row->name;
            $data->iconUrl = $row->icon_url;
            array_push($result, $data);
        }

        return $data;
    }
}
