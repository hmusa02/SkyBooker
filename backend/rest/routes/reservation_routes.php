<?php

require_once __DIR__ . '/../services/ReservationService.class.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Global variable that can be used under this key - reservation_service
Flight::set('reservation_service', new ReservationService());

Flight::group('/reservations', function() {

    /**
     * @OA\Post(
     *      path="/reservations/add",
     *      tags={"reservations"},
     *      summary="Add reservation data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="Reservation data, or exception if reservation is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="Reservation data payload",
     *          @OA\JsonContent(
     *              required={"user_id","flight_id"},
     *              @OA\Property(property="reservation_id", type="string", example="1", description="Reservation ID"),
     *              @OA\Property(property="user_id", type="number", example="1", description="User ID"),
     *              @OA\Property(property="flight_id", type="number", example="1", description="Flight ID"),
     *              @OA\Property(property="status", type="string", example="confirmed", description="Reservation status"),
     *              @OA\Property(property="created_at", type="string", format="date", example="2024-04-29", description="Creation date"),
     *              @OA\Property(property="updated_at", type="string", format="date", example="2024-04-30", description="Update date")
     *          )
     *      )
     * )
     */
    Flight::route('POST /add', function() {
        $payload = Flight::request()->data->getData();

        if($payload['user_id'] == NULL || $payload['user_id'] == '') {
            Flight::halt(500, "User ID field is missing");
        }

        if($payload['reservation_id'] != NULL && $payload['reservation_id'] != ''){
            $reservation = Flight::get('reservation_service')->edit_reservation($payload);
        } else {
            unset($payload['reservation_id']);
            $reservation = Flight::get('reservation_service')->add_reservation($payload);
        }

        Flight::json(['message' => "You have successfully added the reservation", 'data' => $reservation]);
    });

    /**
     * @OA\Delete(
     *      path="/reservations/delete/{reservation_id}",
     *      tags={"reservations"},
     *      summary="Delete reservation by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted reservation data or 500 status code exception otherwise"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="reservation_id", example="1", description="Reservation ID")
     * )
     */
    Flight::route('DELETE /delete/@reservation_id', function($reservation_id) {
        if($reservation_id == NULL || $reservation_id == '') {
            Flight::halt(500, "You have to provide valid reservation id!");
        }

        Flight::get('reservation_service')->delete_reservation_by_id($reservation_id);
        Flight::json(['message' => 'You have successfully deleted the reservation!'], 200);
    });

    /**
     * @OA\Get(
     *      path="/reservations/{reservation_id}",
     *      tags={"reservations"},
     *      summary="Get reservation by id",
     *      @OA\Response(
     *           response=200,
     *           description="Reservation data, or false if reservation does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="reservation_id", example="1", description="Reservation ID")
     * )
     */
    Flight::route('GET /@reservation_id', function($reservation_id) {
        $reservation = Flight::get('reservation_service')->get_reservation_by_id($reservation_id);

        Flight::json($reservation, 200);
    });

    /**
     * @OA\Get(
     *      path="/reservations/all",
     *      tags={"reservations"},
     *      summary="Get all reservations",
     *      @OA\Response(
     *           response=200,
     *           description="Array of all reservations in the database"
     *      )
     * )
     */
    Flight::route('GET /all', function() {
        $data = Flight::get('reservation_service')->get_all_reservations();
        Flight::json($data, 200);
    });

    /**
     * @OA\Get(
     *      path="/reservations/reservation",
     *      tags={"reservations"},
     *      summary="Get reservation by id",
     *      @OA\Response(
     *           response=200,
     *           description="Reservation data, or false if reservation does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="reservation_id", example="1", description="Reservation ID")
     * )
     */
    Flight::route('GET /reservation', function() {
        $params = Flight::request()->query;

        $reservation = Flight::get('reservation_service')->get_reservation_by_id($params['reservation_id']);
        Flight::json($reservation);
    });

    /**
     * @OA\Get(
     *      path="/reservations/get/{reservation_id}",
     *      tags={"reservations"},
     *      summary="Get reservation by id",
     *      @OA\Response(
     *           response=200,
     *           description="Reservation data, or false if reservation does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="reservation_id", example="1", description="Reservation ID")
     * )
     */
    Flight::route('GET /get/@reservation_id', function($reservation_id) {
        $reservation = Flight::get('reservation_service')->get_reservation_by_id($reservation_id);
        Flight::json($reservation);
    });

    /**
     * @OA\Get(
     *      path="/reservations/{reservation_id}",
     *      tags={"reservations"},
     *      summary="Get reservation by id",
     *      @OA\Response(
     *           response=200,
     *           description="Reservation data, or false if reservation does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="reservation_id", example="1", description="Reservation ID")
     * )
     */
    Flight::route('GET /@reservation_id', function($reservation_id) {
        $reservation = Flight::get('reservation_service')->get_reservation_by_id($reservation_id);

        Flight::json($reservation, 200);
    });
});
