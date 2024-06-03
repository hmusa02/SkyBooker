<?php

require_once __DIR__ . '/../services/UserService.class.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Global variable that can be used under this key - user_service
Flight::set('user_service', new UserService());

Flight::group('/users', function() {
    
    /**
     * @OA\Get(
     *      path="/users/info",
     *      tags={"users"},
     *      summary="Get user details",
     *      security={
     *          {"ApiKey": {}}   
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="User details"
     *      )
     * )
     */
    Flight::route('GET /info', function() {
        Flight::json(Flight::get('user_service')->get_user_by_id(Flight::get('user')->id));
    });

    /**
     * @OA\Get(
     *      path="/users/all",
     *      tags={"users"},
     *      summary="Get all users",
     *      @OA\Response(
     *           response=200,
     *           description="Array of all users in the databases"
     *      )
     */
    Flight::route('GET /all', function() {
        $data = Flight::get('user_service')->get_all_users();
        Flight::json($data, 200);
    });

    /**
     * @OA\Get(
     *      path="/users/user",
     *      tags={"users"},
     *      summary="Get user by id",
     *      @OA\Response(
     *           response=200,
     *           description="User data, or false if user does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="user_id", example="1", description="User ID")
     * )
     */
    Flight::route('GET /user', function() {
        $params = Flight::request()->query;

        $user = Flight::get('user_service')->get_user_by_id($params['user_id']);
        Flight::json($user);
    });

    /**
     * @OA\Get(
     *      path="/users/get/{user_id}",
     *      tags={"users"},
     *      summary="Get user by id",
     *      @OA\Response(
     *           response=200,
     *           description="User data, or false if user does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="user_id", example="1", description="User ID")
     * )
     */
    Flight::route('GET /get/@user_id', function($user_id) {
        $user = Flight::get('user_service')->get_user_by_id($user_id);
        Flight::json($user);
    });

    Flight::route('GET /', function() {
        $payload = Flight::request()->query;

        $params = [
            'start' => (int)$payload['start'],
            'search' => $payload['search']['value'],
            'draw' => $payload['draw'],
            'limit' => (int)$payload['length'],
            'order_column' => $payload['order'][0]['name'],
            'order_direction' => $payload['order'][0]['dir'],
        ];

        $data = Flight::get('user_service')->get_users_paginated($params['start'], $params['limit'], $params['search'], $params['order_column'], $params['order_direction']);

        Flight::json([
            'draw' => $params['draw'],
            'data' => $data['data'],
            'recordsFiltered' => $data['count'],
            'recordsTotal' => $data['count'],
            'end' => $data['count']
        ], 200);
    });

    /**
     * @OA\Post(
     *      path="/users/add",
     *      tags={"users"},
     *      summary="Add user data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="User data, or exception if user is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="User data payload",
     *          @OA\JsonContent(
     *              required={"username","email","password"},
     *              @OA\Property(property="user_id", type="string", example="1", description="User ID"),
     *              @OA\Property(property="username", type="string", example="username123", description="User username"),
     *              @OA\Property(property="email", type="string", example="example@example.com", description="User email address"),
     *              @OA\Property(property="full_name", type="string", example="John Doe", description="User full name"),
     *              @OA\Property(property="date_of_birth", type="string", format="date", example="2000-01-01", description="User date of birth"),
     *              @OA\Property(property="password", type="string", example="some_secret_password", description="User password")
     *          )
     *      )
     * )
     */
    Flight::route('POST /add', function() {
        $payload = Flight::request()->data->getData();

        if($payload['username'] == NULL || $payload['username'] == '') {
            Flight::halt(500, "Username field is missing");
        }

        if($payload['user_id'] != NULL && $payload['user_id'] != ''){
            $user = Flight::get('user_service')->edit_user($payload);
        } else {
            unset($payload['user_id']);
            $user = Flight::get('user_service')->add_user($payload);
        }

        Flight::json(['message' => "You have successfully added the user", 'data' => $user]);
    });

    /**
     * @OA\Delete(
     *      path="/users/delete/{user_id}",
     *      tags={"users"},
     *      summary="Delete user by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted user data or 500 status code exception otherwise"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="user_id", example="1", description="User ID")
     * )
     */
    Flight::route('DELETE /delete/@user_id', function($user_id) {
        if($user_id == NULL || $user_id == '') {
            Flight::halt(500, "You have to provide valid user id!");
        }

        Flight::get('user_service')->delete_user_by_id($user_id);
        Flight::json(['message' => 'You have successfully deleted the user!'], 200);
    });

    /**
     * @OA\Get(
     *      path="/users/{user_id}",
     *      tags={"users"},
     *      summary="Get user by id",
     *      @OA\Response(
     *           response=200,
     *           description="User data, or false if user does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="user_id", example="1", description="User ID")
     * )
     */
    Flight::route('GET /@user_id', function($user_id) {
        $user = Flight::get('user_service')->get_user_by_id($user_id);

        Flight::json($user, 200);
    });
});
