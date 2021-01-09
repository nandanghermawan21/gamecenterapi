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
     * @OA\Get(path="/2.0/repositories/{username}",
     *   operationId="getRepositoriesByOwner",
     *   @OA\Parameter(
     *     name="username",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response=200,
     *     description="repositories owned by the supplied user",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/category")
     *     ),
     *     @OA\Link(link="userRepository", ref="#/components/links/UserRepository")
     *   )
     * )
     * @OA\Link(link="UserRepositories",
     *   operationId="getRepositoriesByOwner",
     *   parameters={"username"="$response.body#/username"}
     * )
     */
    public function all_get()
    {
        $data = $this->category->getAll();
        $this->response($data, 200); // OK (200) being the HTTP response code
    }
}
