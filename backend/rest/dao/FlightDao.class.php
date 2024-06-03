<?php

require_once __DIR__ . '/BaseDao.class.php';

class FlightDao extends BaseDao {
    public function __construct() {
        parent::__construct('flights');
    }

    public function get_all_flights() {
        $query = "SELECT * FROM flights";
        return $this->query($query, []);
    }

    public function get_flight_by_id($flight_id) {
        return $this->query_unique(
            "SELECT * FROM flights WHERE flight_id = :flight_id", 
            ['flight_id' => $flight_id]
        );
    }

    public function add_flight($flight) {
        return $this->insert('flights', $flight);
    }

    public function edit_flight($flight_id, $flight) {
        $query = "UPDATE flights SET 
            airline_id = :airline_id,
            departure_airport_id = :departure_airport_id,
            arrival_airport_id = :arrival_airport_id,
            departure_time = :departure_time,
            arrival_time = :arrival_time,
            price = :price,
            status = :status
            WHERE flight_id = :flight_id";
            
        $this->execute($query, [
            'airline_id' => $flight['airline_id'],
            'departure_airport_id' => $flight['departure_airport_id'],
            'arrival_airport_id' => $flight['arrival_airport_id'],
            'departure_time' => $flight['departure_time'],
            'arrival_time' => $flight['arrival_time'],
            'price' => $flight['price'],
            'status' => $flight['status'],
            'flight_id' => $flight_id
        ]);
    }

    public function delete_flight_by_id($flight_id) {
        $query = "DELETE FROM flights WHERE flight_id = :flight_id";
        $this->execute($query, ['flight_id' => $flight_id]);
    }
}
?>
