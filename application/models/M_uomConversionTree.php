<?php if (!defined('BASEPATH')) exit('No direct script allowed');

/**
 * @OA\Schema(schema="uomConversionTree")
 */
class M_uomConversionTree extends CI_Model
{
    /**
     * @OA\Property()
     * @var int
     */
    public $conversionId;

    /**
     * @OA\Property()
     * @var int
     */
    public $uomSourceId;

    /**
     * @OA\Property()
     * @var int
     */
    public $uomTargetId;

    /**
     * @OA\Property()
     * @var int
     */
    public $conversionAmount;

    function fromRow($row)
    {
        $data = new M_uomConversionTree();
        $data->conversionId = $row->conversion_id;
        $data->uomSourceId = $row->uom_source_id;
        $data->uomTargetId = $row->uom_target_id;
        $data->conversionAmount = $row->conversion_amount;
        return $data;
    }

    function fromJson($json)
    {
        $data = new M_uomConversionTree();

        if (isset($json['conversionId'])) {
            $data->conversionId = $json["conversionId"];
        }
        if (isset($json['uomSourceId'])) {
            $data->uomSourceId = $json["uomSourceId"];
        }
        if (isset($json['uomTargetId'])) {
            $data->uomTargetId = $json["uomTargetId"];
        }
        if (isset($json['conversionAmount'])) {
            $data->conversionAmount = $json["conversionAmount"];
        }

        return $data;
    }

    function toRow()
    {
        $data = new stdClass();
        $data->conversion_id = $this->conversionId;
        $data->uom_source_id = $this->uomSourceId;
        $data->uom_target_id = $this->uomTargetId;
        $data->conversion_amount = $this->conversionAmount;

        return $data;
    }


    function getAll()
    {
        $query = $this->db->get('m_uom_conversion_tree');

        $result = [];
        foreach ($query->result() as $row) {
            array_push($result, $this->fromRow($row));
        }

        return $result;
    }

    function add(\M_uomConversionTree $uomConversionTree)
    {
        $this->db->insert('m_uom_conversion_tree', $uomConversionTree->toRow());

        $data = $this->db->get_where('m_uom_conversion_tree', array(
            'conversion_id' => $uomConversionTree->conversionId,
            'uom_source_id' => $uomConversionTree->uomSourceId,
            'uom_target_id' => $uomConversionTree->uomTargetId,
        ));

        return $this->fromRow($data->result()[0]);
    }

    function update($id, \M_uomConversionTree $uomConversionTree)
    {
        $data = array(
            'conversion_id' => $uomConversionTree->conversionId,
            'uom_source_id' => $uomConversionTree->uomSourceId,
            'uom_target_id' => $uomConversionTree->uomTargetId,
        );

        $this->db->where('conversion_id', $id);
        $this->db->update('m_uom_conversion_tree', $data);

        $data = $this->db->get_where('m_uom_conversion_tree', array(
            'conversion_id' => $uomConversionTree->conversionId,
            'uom_source_id' => $uomConversionTree->uomSourceId,
            'uom_target_id' => $uomConversionTree->uomTargetId,
        ));

        return $this->fromRow($data->result()[0]);
    }
}
