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
class Productcategory extends BD_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->helper('string');
        $this->load->model("m_category", "category");
        $this->load->model('errormodel', 'errormodel');
    }

    /**
     * @OA\Get(path="/api/productcategory/all",tags={"productCategory"},
     *   operationId="getAllCategory",
     *   @OA\Response(response=200,
     *     description="categpry product",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/category")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function all_get()
    {
        $data = $this->category->getAll();
        $this->response($data, 200); // OK (200) being the HTTP response code
    }

    /**
     * @OA\Post(path="/api/productcategory/add",tags={"productCategory"},
     *   operationId="add category",
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/category")
     *     )
     *   ),
     *   @OA\Response(response=200,
     *     description="categpry product",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/category")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function add_post()
    {
        try {
            $jsonBody  = json_decode(file_get_contents('php://input'), true);
            $category = $this->category->fromJson($jsonBody);

            if ($category->id == "" || $category->id == null) {
                $category->id = random_string('alnum', 10);
            }

            $result = $this->category->add($category);

            $this->response($result, 200);
        } catch (\Exception $e) {
            $error = new errormodel();
            $error->status = 500;
            $error->message = $e->getMessage();

            $this->response($error, 500);
        }
    }

    /**
     * @OA\Post(path="/api/productcategory/remove",tags={"productCategory"},
     * operationId="remove category",
     * @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="id",
     *                  type="string",
     *                  description="id"
     *              ),
     *          )
     *      )
     *  ),
     *   @OA\Response(response=200,
     *     description="categpry product",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/category")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function remove_post()
    {
        $id = $this->post('id');

        $result = $this->category->remove($id);

        $this->response($result, 200);
    }

    /**
     * @OA\Post(path="/api/productcategory/add",tags={"productCategory"},
     *   operationId="add category",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(ref="#/components/schemas/category")
     *     ),
     *   ),
     *   @OA\Response(response=200,
     *     description="categpry product",
     *     @OA\JsonContent(type="array",
     *       @OA\Items(ref="#/components/schemas/category")
     *     ),
     *   ),
     *   security={{"token": {}}},
     * )
     */
    public function update_post()
    {

        $id = $this->post('id');
        $jsonBody  = json_decode(file_get_contents('php://input'), true);
        $category = $this->category->fromJson($jsonBody);

        $result = $this->category->update()($id, $category);

        $this->response($result, 200);
    }
}
