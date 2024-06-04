<?php

require_once __DIR__ . '/../dao/ReservationDao.class.php';

class ReservationService {
    private $reservation_dao;
    
    public function __construct() {
        $this->reservation_dao = new ReservationDao();
    }

    public function get_all_reservations() {
        return $this->reservation_dao->get_all_reservations();
    }

    public function get_reservation_by_id($reservation_id) {
        return $this->reservation_dao->get_reservation_by_id($reservation_id);
    }

    public function add_reservation($reservation) {
        return $this->reservation_dao->add_reservation($reservation);
    }

    public function update_reservation($reservation_id, $reservation) {
        return $this->reservation_dao->edit_reservation($reservation_id, $reservation);
    }

    public function delete_reservation($reservation_id) {
        return $this->reservation_dao->delete_reservation_by_id($reservation_id);
    }
}
?>
