<?php if (!defined('BASEPATH')) exit('No direct script allowed');

/**
 * @OA\Schema(schema="uomConversion")
 */
class M_uomConversion extends CI_Model
{
    /**
     * @OA\Property()
     * @var int
     */
    public $conversionId;

    /**
     * @OA\Property()
     * @var String
     */
    public $conversionName;

    /**
     * @OA\Property()
     * @var int
     */
    public $uomBasicId;

    function fromRow($row)
    {
        $data = new M_uomConversion();
        $data->conversionId = $row->conversion_id;
        $data->conversionName = $row->conversion_name;
        $data->uomBasicId = $row->uom_basic_id;
        return $data;
    }

    function fromJson($json)
    {
        $data = new M_uomConversion;

        if (isset($json['conversionId'])) {
            $data->conversionId = $json["conversionId"];
        }
        if (isset($json['conversionName'])) {
            $data->conversionName = $json["conversionName"];
        }
        if (isset($json['uomBasicId'])) {
            $data->uomBasicId = $json["uomBasicId"];
        }

        return $data;
    }

    function toRow()
    {
        $data = new M_uomConversion;
        $data->conversion_id = $this->conversionId;
        $data->conversion_name = $this->conversionName;
        $data->uom_basic_id = $this->uomBasicId;

        return $data;
    }


    function getAll()
    {
        $query = $this->db->get('m_uom_conversion');

        $result = [];
        foreach ($query->result() as $row) {
            array_push($result, $this->fromRow($row));
        }

        return $result;
    }

    function add($uomConversion)
    {
        $this->db->insert('m_uom_conversion', $uomConversion->toRow());

        $data = $this->db->get_where('m_uom_conversion', array('id' => $uomConversion->id));

        return $this->fromRow($data->result()[0]);
    }

    function update($id, \M_uomConversion $uom)
    {
        $data = array(
            'conversion_id' => $uom->conversionId,
            'conversion_name' => $uom->conversionName,
            'uom_basic_id' => $uom->uomBasicId,
        );

        $this->db->where('conversion_id', $id);
        $this->db->update('m_uom_conversion', $data);

        $data = $this->db->get_where('m_uom_conversion', array('conversion_id' => $id));

        return $this->fromRow($data->result()[0]);
    }
}
