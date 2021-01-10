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
class Fileservice extends BD_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        //mendefinisikan folder upload
        define("UPLOAD_DIR", "../../../upload/");
    }

    /**
     * @OA\Post(path="/api/Fileservice/upload",tags={"fileService"},
     *   operationId="upload file",
     *     	@OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="media",
     *                      description="media",
     *                      type="file",
     *                      @OA\Items(type="string", format="binary")
     *                   ),
     *               ),
     *           ),
     *       ),
     *   security={{"token": {}}},
     * )
     */
    public function do_upload()
    {
        if (!empty($_FILES["media"])) {
            $media    = $_FILES["media"];
            $ext    = pathinfo($_FILES["media"]["name"], PATHINFO_EXTENSION);
            $size    = $_FILES["media"]["size"];
            $tgl    = date("Y-m-d");

            if ($media["error"] !== UPLOAD_ERR_OK) {
                $this->response("upload gagal", 500);
                exit;
            }

            // filename yang aman
            $name = preg_replace("/[^A-Z0-9._-]/i", "_", $media["name"]);

            // mencegah overwrite filename
            $i = 0;
            $parts = pathinfo($name);
            while (file_exists(UPLOAD_DIR . $name)) {
                $i++;
                $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
            }

            $success = move_uploaded_file($media["tmp_name"], UPLOAD_DIR . $name);
            if ($success) {
                // $in = $conn->query("INSERT INTO files(tgl_upload, file_name, file_size, file_type) VALUES('$tgl', '$name', '$size', '$ext')");
                // $q = $conn->query("SELECT id FROM files ORDER BY id DESC LIMIT 1");
                // $rq = $q->fetch_assoc();
                // echo $rq['id'];
                $this->response("Ok", 200);
                exit;
            }
            chmod(UPLOAD_DIR . $name, 0644);
        }
    }
}
