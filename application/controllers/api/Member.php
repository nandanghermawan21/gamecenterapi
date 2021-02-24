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
class Member extends BD_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->helper('string');
        $this->load->model("m_member", "member");
        $this->load->model('errormodel', 'errormodel');
    }



    /**
     * @OA\Post(path="/api/member/add",tags={"member"},
     *   operationId="add member",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/member")
     *     )
     *   ),
     *   @OA\Response(response=200,
     *     description="add member",
     *     @OA\JsonContent(
     *       @OA\Items(ref="#/components/schemas/member")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function add_post()
    {
        try {
            $jsonBody  = json_decode(file_get_contents('php://input'), true);
            $result = $this->member->fromJson($jsonBody)->add();
            $this->response($result, 200);
        } catch (\Exception $e) {
            $error = new errormodel();
            $error->status = 500;
            $error->message = $e->getMessage();
            $this->response($error, 500);
        }
    }
}
