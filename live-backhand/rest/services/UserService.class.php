<?php

require_once __DIR__ . '/../dao/UserDao.class.php';

class UserService {
  private $user_dao;
  public function __construct() {
    $this->user_dao = new UserDao();
  }
  public function add_user($user){
    return $this->user_dao->add_user($user);

  }

  public function get_users_paginated($offset, $limit, $search, $order_column, $order_direction){
    $count = $this->user_dao->count_users_paginated($search)['count'];
    $rows = $this->user_dao->get_users_paginated($offset, $limit, $search, $order_column, $order_direction);

    return [
        'count' => $count,
        'data' => $rows
    ];
}
}