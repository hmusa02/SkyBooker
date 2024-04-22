<?php

require_once __DIR__ . '/BaseDao.class.php';

class UserDao extends BaseDao {
  public function __construct() {
    parent::__construct('users');
    
  }

  public function add_user($user){
    
     return $this->insert('users', $user); 
    

}
public function count_users_paginated($search) {
  $query = "SELECT COUNT(*) AS count
            FROM users
            WHERE LOWER(email) LIKE CONCAT('%', :search, '%') OR 
                  LOWER(password) LIKE CONCAT('%', :search, '%');";
  return $this->query_unique($query, [
      'search' => $search
  ]);
}

public function get_users_paginated($offset, $limit, $search, $order_column, $order_direction) {
  $query = "SELECT *
            FROM users
            WHERE LOWER(email) LIKE CONCAT('%', :search, '%') OR 
                  LOWER(password) LIKE CONCAT('%', :search, '%')
            ORDER BY {$order_column} {$order_direction}
            LIMIT {$offset}, {$limit}";
  return $this->query($query, [
      'search' => $search
  ]);
}

}