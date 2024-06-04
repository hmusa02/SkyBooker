<?php
require_once __DIR__ . '/BaseDao.class.php';

class UserDao extends BaseDao {
    public function __construct() {
        parent::__construct('users');
    }

    // Metoda za dodavanje novog korisnika
    public function add_user($user){
        return $this->insert('users', $user);
    }

    // Metoda za brojanje korisnika s paginacijom
    public function count_users_paginated($search) {
        $query = "SELECT COUNT(*) AS count
                  FROM users
                  WHERE LOWER(username) LIKE CONCAT('%', :search, '%') OR 
                        LOWER(email) LIKE CONCAT('%', :search, '%') OR
                        LOWER(full_name) LIKE CONCAT('%', :search, '%');";
        return $this->query_unique($query, [
            'search' => $search
        ]);
    }

    // Metoda za dohvaćanje korisnika s paginacijom
    public function get_users_paginated($offset, $limit, $search, $order_column, $order_direction) {
        $query = "SELECT *
                  FROM users
                  WHERE LOWER(username) LIKE CONCAT('%', :search, '%') OR 
                        LOWER(email) LIKE CONCAT('%', :search, '%') OR
                        LOWER(full_name) LIKE CONCAT('%', :search, '%')
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";
        return $this->query($query, [
            'search' => $search
        ]);
    }

    // Metoda za brisanje korisnika po ID-u
    public function delete_user_by_id($id) {
        $query = "DELETE FROM users WHERE user_id = :id";
        $this->execute($query, [
            'id' => $id
        ]);
    }

    // Metoda za dohvaćanje korisnika po ID-u
    public function get_user_by_id($user_id){
        return $this->query_unique(
            "SELECT *, DATE(created_at) as created_at FROM users WHERE user_id = :id", 
            [
                'id' => $user_id
            ]
        );
    }

    // Metoda za uređivanje korisnika
    public function edit_user($id, $user) {
        $query = "UPDATE users SET username = :username, password_hash = :password_hash, email = :email, full_name = :full_name, date_of_birth = :date_of_birth
                  WHERE user_id = :id";
        $this->execute($query, [
            'username' => $user['username'],
            'password_hash' => $user['password_hash'],
            'email' => $user['email'],
            'full_name' => $user['full_name'],
            'date_of_birth' => $user['date_of_birth'],
            'id' => $id
        ]);
    }

    // Metoda za dohvaćanje svih korisnika
    public function get_all_users(){
        $query = "SELECT *
                  FROM users;";
        return $this->query($query, []);
    }
}
?>
