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
            $member = $this->member->fromJson($jsonBody);

            if ($member->checkUsernameExist() == true) {
                $this->response("Username Is Exist", 400);
            } else if ($member->checkEmailExist() == true) {
                $this->response("Email Is Exist", 400);
            } else if ($member->checkPhoneExist() == true) {
                $this->response("Phone Is Exist", 400);
            } else {
                $result = $this->member->fromJson($jsonBody)->add();
                $this->response($result, 200);
            }
        } catch (\Exception $e) {
            $error = new errormodel();
            $error->status = 500;
            $error->message = $e->getMessage();
            $this->response($error, 500);
        }
    }

    /**
     * @OA\Get(path="/api/member/get",tags={"member"},
     *   operationId="get member",
     *   @OA\Parameter(
     *       name="id",
     *       in="query",
     *       required=false,
     *       @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *       name="searchKey",
     *       in="query",
     *       required=false,
     *       @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *       name="skip",
     *       in="query",
     *       required=false,
     *       @OA\Schema(type="int")
     *   ),
     *   @OA\Parameter(
     *       name="limit",
     *       in="query",
     *       required=false,
     *       @OA\Schema(type="int")
     *   ),
     *   @OA\Response(response=200,
     *     description="get member",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/member")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function get_get()
    {
        $id = $this->get("id", true);
        $serchKey = $this->get("searchKey", true);
        $limit = $this->get("limit", true);
        $skip = $this->get("skip", true);
        $data = $this->member->get($id, $serchKey, $skip, $limit);
        $this->response($data, 200); // OK (200) being the HTTP response code
    }

    /**
     * @OA\Get(path="/api/member/addpoint",tags={"member"},
     *   operationId="add point",
     *   @OA\Parameter(
     *       name="id",
     *       in="query",
     *       required=false,
     *       @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *       name="point",
     *       in="query",
     *       required=false,
     *       @OA\Schema(type="int")
     *   ),
     *   @OA\Response(response=200,
     *     description="get member",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/member")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function addpoint_get()
    {
        $id = $this->get("id", true);
        $point = $this->get("point", true);
        $data = $this->member->fromId($id)->addPoint($point);
        $this->response($data, 200); // OK (200) being the HTTP response code
    }

    /**
     * @OA\Get(path="/api/member/buySilverTicket",tags={"member"},
     *   operationId="buySilverTicket",
     *   @OA\Parameter(
     *       name="id",
     *       in="query",
     *       required=false,
     *       @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response=200,
     *     description="get member",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/member")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function buySilverTicket_get()
    {
        $id = $this->get("id", true);

        $member = $this->member->fromId($id);

        if ($member->point < $this->config->item('silver_ticket_price')) {
            $this->response("Not Enought Point", 400);
        } else {
            $member = $member->buySilverTicket();
        }

        $this->response($member, 200); // OK (200) being the HTTP response code
    }

    /**
     * @OA\Get(path="/api/member/buyGoldTicket",tags={"member"},
     *   operationId="buyGoldTicket",
     *   @OA\Parameter(
     *       name="id",
     *       in="query",
     *       required=false,
     *       @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response=200,
     *     description="get member",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/member")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function buyGoldTicket_get()
    {
        $id = $this->get("id", true);

        $member = $this->member->fromId($id);

        if ($member->point < $this->config->item('gold_ticket_price')) {
            $this->response("Not Enought Point", 400);
        } else {
            $member = $member->buySilverTicket();
        }

        $this->response($member, 200); // OK (200) being the HTTP response code
    }
}
