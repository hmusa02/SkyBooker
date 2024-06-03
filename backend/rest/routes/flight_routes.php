<?php

require_once __DIR__ . '/../services/FlightService.class.php';

// Global variable that can be used under this key - flight_service
Flight::set('flight_service', new FlightService());

Flight::group('/flights', function() {
    
    /**
     * @OA\Get(
     *      path="/flights/all",
     *      tags={"flights"},
     *      summary="Get all flights",
     *      @OA\Response(
     *           response=200,
     *           description="Array of all flights in the database"
     *      )
     * )
     */
    Flight::route('GET /all', function() {
        $data = Flight::get('flight_service')->get_all_flights();
        Flight::json($data, 200);
    });

    /**
     * @OA\Get(
     *      path="/flights/{flight_id}",
     *      tags={"flights"},
     *      summary="Get flight by id",
     *      @OA\Response(
     *           response=200,
     *           description="Flight data, or false if flight does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="flight_id", example="1", description="Flight ID")
     * )
     */
    Flight::route('GET /@flight_id', function($flight_id) {
        $flight = Flight::get('flight_service')->get_flight_by_id($flight_id);
        Flight::json($flight);
    });

    /**
     * @OA\Post(
     *      path="/flights/add",
     *      tags={"flights"},
     *      summary="Add flight data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="Flight data, or exception if flight is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="Flight data payload",
     *          @OA\JsonContent(
     *              required={"airline_id","departure_airport_id","arrival_airport_id","departure_time","arrival_time","price","status"},
     *              @OA\Property(property="flight_id", type="string", example="1", description="Flight ID"),
     *              @OA\Property(property="airline_id", type="number", example="1", description="Airline ID"),
     *              @OA\Property(property="departure_airport_id", type="number", example="1", description="Departure Airport ID"),
     *              @OA\Property(property="arrival_airport_id", type="number", example="1", description="Arrival Airport ID"),
     *              @OA\Property(property="departure_time", type="string", format="datetime", example="2024-04-29 12:00:00", description="Departure time"),
     *              @OA\Property(property="arrival_time", type="string", format="datetime", example="2024-04-29 15:00:00", description="Arrival time"),
     *              @OA\Property(property="price", type="number", format="float", example="120.50", description="Flight price"),
     *              @OA\Property(property="status", type="string", example="scheduled", description="Flight status")
     *          )
     *      )
     * )
     */
    Flight::route('POST /add', function() {
        $payload = Flight::request()->data->getData();

        if($payload['departure_airport_id'] == NULL || $payload['departure_airport_id'] == '') {
            Flight::halt(500, "Departure airport ID field is missing");
        }

        if($payload['flight_id'] != NULL && $payload['flight_id'] != ''){
            $flight = Flight::get('flight_service')->update_flight($payload['flight_id'], $payload);
        } else {
            unset($payload['flight_id']);
            $flight = Flight::get('flight_service')->add_flight($payload);
        }

        Flight::json(['message' => "You have successfully added the flight", 'data' => $flight]);
    });

    /**
     * @OA\Delete(
     *      path="/flights/delete/{flight_id}",
     *      tags={"flights"},
     *      summary="Delete flight by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted flight data or 500 status code exception otherwise"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="flight_id", example="1", description="Flight ID")
     * )
     */
    Flight::route('DELETE /delete/@flight_id', function($flight_id) {
        if($flight_id == NULL || $flight_id == '') {
            Flight::halt(500, "You have to provide valid flight id!");
        }

        Flight::get('flight_service')->delete_flight($flight_id);
        Flight::json(['message' => 'You have successfully deleted the flight!'], 200);
    });

    /**
     * @OA\Get(
     *      path="/flights/{flight_id}",
     *      tags={"flights"},
     *      summary="Get flight by id",
     *      @OA\Response(
     *           response=200,
     *           description="Flight data, or false if flight does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="flight_id", example="1", description="Flight ID")
     * )
     */
    Flight::route('GET /@flight_id', function($flight_id) {
        $flight = Flight::get('flight_service')->get_flight_by_id($flight_id);

        Flight::json($flight, 200);
    });
});
