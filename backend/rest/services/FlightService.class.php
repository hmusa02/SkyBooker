<?php

require_once __DIR__ . '/../dao/FlightDao.class.php';

class FlightService {
    private $flight_dao;
    
    public function __construct() {
        $this->flight_dao = new FlightDao();
    }

    public function get_all_flights() {
        return $this->flight_dao->get_all_flights();
    }

    public function get_flight_by_id($flight_id) {
        return $this->flight_dao->get_flight_by_id($flight_id);
    }

    public function add_flight($flight) {
        return $this->flight_dao->add_flight($flight);
    }

    public function update_flight($flight_id, $flight) {
        return $this->flight_dao->edit_flight($flight_id, $flight);
    }

    public function delete_flight($flight_id) {
        return $this->flight_dao->delete_flight_by_id($flight_id);
    }
}
?>
