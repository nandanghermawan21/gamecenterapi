<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @OA\Info(title="Game Center API", version="0.1")
 * @OA\SecurityScheme(
 *   securityScheme="token",
 *   type="apiKey",
 *   name="Authorization",
 *   in="header"
 * )
 */
class Uom extends BD_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->helper('string');
        $this->load->model("m_uom", "uom");
        $this->load->model("m_uomConversion", "uomConversion");
        $this->load->model("m_uomConversionTree", "uomConversionTree");
        $this->load->model('errormodel', 'errormodel');
    }

    /**
     * @OA\Get(path="/api/uom/all",tags={"uom"},
     *   operationId="getAllUom",
     *   @OA\Response(response=200,
     *     description="UOM Master",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/uom")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function all_get()
    {
        $data = $this->uom->getAll();
        $this->response($data, 200); // OK (200) being the HTTP response code
    }

    /**
     * @OA\Get(path="/api/uom/alluomconversion",tags={"uom"},
     *   operationId="getAllUomConversion",
     *   @OA\Response(response=200,
     *     description="UOM Master Conversion",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/uomConversion")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function alluomconversion_get()
    {
        $data = $this->uomConversion->getAll();
        $this->response($data, 200); // OK (200) being the HTTP response code
    }

    /**
     * @OA\Get(path="/api/uom/alluomconversiontree",tags={"uom"},
     *   operationId="alluomconversiontree",
     *   @OA\Response(response=200,
     *     description="UOM Master Conversion Tree",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/uomConversionTree")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function alluomconversiontree_get()
    {
        $data = $this->uomConversionTree->getAll();
        $this->response($data, 200); // OK (200) being the HTTP response code
    }


    /**
     * @OA\Post(path="/api/uom/add",tags={"uom"},
     *   operationId="add Uom",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/uom")
     *     )
     *   ),
     *   @OA\Response(response=200,
     *     description="categpry product",
     *     @OA\JsonContent(
     *       @OA\Items(ref="#/components/schemas/uom")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function add_post()
    {
        try {
            $jsonBody  = json_decode(file_get_contents('php://input'), true);
            $uom = $this->uom->fromJson($jsonBody);

            if ($uom->uomId == "" || $uom->uomId == null) {
                $uom->uomId = random_string('num', 10);
            }

            $result = $this->category->add($uom);

            $this->response($result, 200);
        } catch (\Exception $e) {
            $error = new errormodel();
            $error->status = 500;
            $error->message = $e->getMessage();

            $this->response($error, 500);
        }
    }

    /**
     * @OA\Post(path="/api/uom/adduomconversion",tags={"uom"},
     *   operationId="add Uom Conversion",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/uomConversion")
     *     )
     *   ),
     *   @OA\Response(response=200,
     *     description="categpry product",
     *     @OA\JsonContent(
     *       @OA\Items(ref="#/components/schemas/uomConversion")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function addUomConversion_post()
    {
        try {
            $jsonBody  = json_decode(file_get_contents('php://input'), true);
            $uomConversion = $this->uomConversion->fromJson($jsonBody);

            if ($uomConversion->conversionId == "" || $uomConversion->conversionId == null) {
                $uomConversion->conversionId = random_string('num', 10);
            }

            $result = $this->category->add($uomConversion);

            $this->response($result, 200);
        } catch (\Exception $e) {
            $error = new errormodel();
            $error->status = 500;
            $error->message = $e->getMessage();

            $this->response($error, 500);
        }
    }

    /**
     * @OA\Post(path="/api/uom/update",tags={"uom"},
     *   operationId="update uom",
     *   @OA\Parameter(
     *     name="id",
     *     in="query",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/uom")
     *     ),
     *   ),
     *   @OA\Response(response=200,
     *     description="categpry product",
     *     @OA\JsonContent(
     *       @OA\Items(ref="#/components/schemas/uom")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function update_post()
    {
        $id = $this->input->get('id', TRUE);
        $jsonBody  = json_decode(file_get_contents('php://input'), true);
        $category = $this->category->fromJson($jsonBody);

        $result = $this->uom->update($id, $category);

        $this->response($result, 200);
    }
}
