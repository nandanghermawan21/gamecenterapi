<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @OA\Info(title="Game Center API", version="0.1")
 */
class Productcategory extends BD_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->model("m_category", "category");
    }

    /**
     * @OA\Get(path="/api/productcategory/all",
     *   operationId="getAllCategory",
     *   @OA\Response(response=200,
     *     description="categpry product",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/category")
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="Authorization",
     *     in="header",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     * )
     */
    public function all_get()
    {
        $data = $this->category->getAll();
        $this->response($data, 200); // OK (200) being the HTTP response code
    }
}
