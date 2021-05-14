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
class Voucher extends BD_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->helper('string');
        $this->load->model("m_voucher", "voucher");
        $this->load->model('errormodel', 'errormodel');
    }



    /**
     * @OA\Post(path="/api/voucher/add",tags={"voucher"},
     *   operationId="add voucher",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/voucher")
     *     )
     *   ),
     *   @OA\Response(response=200,
     *     description="add voucher",
     *     @OA\JsonContent(
     *       @OA\Items(ref="#/components/schemas/voucher")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function add_post()
    {
        if ($this->user_data->type == "admin") {
            try {
                $count = $this->post("count");
                $jsonBody  = json_decode(file_get_contents('php://input'), true);
                $voucher = $this->voucher->fromJson($jsonBody);
                $result = $voucher->addBatch($count);
                $this->response($result, 200);
            } catch (\Exception $e) {
                $error = new errormodel();
                $error->status = 500;
                $error->message = $e->getMessage();
                $this->response($error, 500);
            }
        } else {
            $this->response("Access Denied", 401);
        }
    }
}
