<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

/**
 * @OA\Info(title="Game Center API", version="0.1")
 */
class Auth extends BD_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('M_user', 'user');
        $this->load->model('M_member', 'member');
    }

    /**
     * @OA\Post(path="/api/auth/login",tags={"Auth"},
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
     *   @OA\Response(response=200,
     *     description="basic user info",
     *     @OA\JsonContent(
     *       @OA\Items(ref="#/components/schemas/user")
     *     ),
     *   ),
     * )
     */
    public function login_post()
    {
        $u = $this->post('username'); //Username Posted
        $p = sha1($this->post('password')); //Pasword Posted
        $q = array('username' => $u); //For where query condition
        $kunci = $this->config->item('thekey');
        $invalidLogin = ['status' => 'Invalid Login']; //Respon if login invalid
        $val = $this->user->get_user($q)->row(); //Model to get single data row from database base on username
        if ($this->user->get_user($q)->num_rows() == 0) {
            $this->response($invalidLogin, REST_Controller::HTTP_NOT_FOUND);
        }
        $match = $val->password;   //Get password for user from database
        if ($p == $match) {  //Condition if password matched
            $token['id'] = $val->id;  //From here
            $token['username'] = $u;
            $token['type'] = "admin";
            $date = new DateTime();
            $token['iat'] = $date->getTimestamp();
            $token['exp'] = $date->getTimestamp() + 60 * 60 * 5; //To here is to generate token
            $output['token'] = JWT::encode($token, $kunci); //This is the output token

            //result the user
            $user = $this->user->fromRow($val);
            $user->token = $output['token'];

            $this->set_response($user, REST_Controller::HTTP_OK); //This is the respon if success

        } else {
            $this->set_response($invalidLogin, REST_Controller::HTTP_NOT_FOUND); //This is the respon if failed
        }
    }


    /**
     * @OA\Post(path="/api/auth/memberlogin",tags={"Auth"},
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
     *   @OA\Response(response=200,
     *     description="basic user info",
     *     @OA\JsonContent(
     *       @OA\Items(ref="#/components/schemas/user")
     *     ),
     *   ),
     * )
     */
    public function memberlogin_post()
    {
        $u = $this->post('username'); //Username Posted
        $p = $this->post('password'); //Pasword Posted
        $kunci = $this->config->item('thekey');
        $invalidLogin = ['status' => 'Invalid Login']; //Respon if login invalid
        $val = $this->member->login($u, $p); //Model to get single data row from database base on username
        if ($val == null) {
            $this->response($invalidLogin, REST_Controller::HTTP_NOT_FOUND);
        } else {
            $token['id'] = $val->id;  //From here
            $token['username'] = $u;
            $token['type'] = "member";
            $date = new DateTime();
            $token['iat'] = $date->getTimestamp();
            $token['exp'] = $date->getTimestamp() + 60 * 60 * 5; //To here is to generate token
            $output['token'] = JWT::encode($token, $kunci); //This is the output token

            //result the user
            $user = $val;
            $user->token = $output['token'];

            $this->set_response($user, REST_Controller::HTTP_OK); //This is the respon if success
        }
    }
}
