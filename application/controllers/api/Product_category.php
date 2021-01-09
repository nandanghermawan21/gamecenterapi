<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @OA\Info(title="Game Center API", version="0.1")
 */
class Main extends BD_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->model("m_category", "category");
    }

    /**
     * @OA\Post(path="/api/category/all",tags={"Category"},
     * @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="username",
     *                  type="string",
     *                  description="username"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  description="password"
     *              )
     *          )
     *      )
     *  ),
     * @OA\Response(response="200", description="An example resource"),
     * @OA\Response(response="404", description="not found")
     * )
     */
    public function all_get()
    {
        $data = $this->category->getAll();
        $this->response($data, 200); // OK (200) being the HTTP response code
    }
}
