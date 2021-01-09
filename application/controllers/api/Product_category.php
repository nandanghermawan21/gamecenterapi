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


    public function all_get()
    {
        $data = $this->category->getAll();
        $this->response($data, 200); // OK (200) being the HTTP response code
    }
}
