<?php
require_once __DIR__ . '/BaseDao.class.php';

class ReservationDao extends BaseDao {
    public function __construct() {
        parent::__construct('reservations');
    }

    // Metoda za dodavanje nove rezervacije
    public function add_reservation($reservation){
        return $this->insert('reservations', $reservation);
    }

    // Metoda za dohvaćanje rezervacije po ID-u
    public function get_reservation_by_id($reservation_id){
        return $this->query_unique(
            "SELECT * FROM reservations WHERE reservation_id = :id", 
            [
                'id' => $reservation_id
            ]
        );
    }

    // Metoda za brisanje rezervacije po ID-u
    public function delete_reservation_by_id($id) {
        $query = "DELETE FROM reservations WHERE reservation_id = :id";
        $this->execute($query, [
            'id' => $id
        ]);
    }

    // Metoda za dohvaćanje svih rezervacija
    public function get_all_reservations(){
        $query = "SELECT *
                  FROM reservations;";
        return $this->query($query, []);
    }

    // Metoda za ažuriranje rezervacije
    public function edit_reservation($id, $reservation) {
        $query = "UPDATE reservations SET user_id = :user_id, flight_id = :flight_id, status = :status, created_at = :created_at, updated_at = :updated_at
                  WHERE reservation_id = :id";
        $this->execute($query, [
            'user_id' => $reservation['user_id'],
            'flight_id' => $reservation['flight_id'],
            'status' => $reservation['status'],
            'created_at' => $reservation['created_at'],
            'updated_at' => $reservation['updated_at'],
            'id' => $id
        ]);
    }

    // Metoda za dohvaćanje rezervacija s paginacijom
    public function get_reservations_paginated($offset, $limit, $search, $order_column, $order_direction) {
        $query = "SELECT *
                  FROM reservations
                  WHERE LOWER(status) LIKE CONCAT('%', :search, '%')
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";
        return $this->query($query, [
            'search' => $search
        ]);
    }

    // Metoda za brojanje rezervacija s paginacijom
    public function count_reservations_paginated($search) {
        $query = "SELECT COUNT(*) AS count
                  FROM reservations
                  WHERE LOWER(status) LIKE CONCAT('%', :search, '%');";
        return $this->query_unique($query, [
            'search' => $search
        ]);
    }
}
?>
