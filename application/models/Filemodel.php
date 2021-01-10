<?php if (!defined('BASEPATH')) exit('No direct script allowed');


/**
 * @OA\Schema(schema="filemodel")
 */
class filemodel extends CI_Model
{
    /**
     * @OA\Property()
     * @var string
     */
    public $filename;

    /**
     * @OA\Property()
     * @var int
     */
    public $size;

    /**
     * @OA\Property()
     * @var string
     */
    public $extention;

    /**
     * @OA\Property()
     * @var string
     */
    public $path;
}
