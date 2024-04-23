<?php

require_once __DIR__ . '/../dao/BaseDao.class.php';

class UserDao extends BaseDao
{
  public function __construct()
  {
    parent::__construct('users');
  }
  public function add_user($user)
  {
    $stmt = $this->connection->prepare("INSERT INTO employees (user_id, username, password_hash, email, full_name, date_of_birth, created_at, updated_at) VALUES (:user_id, :username, :password_hash, :email, :full_name, :date_of_birth, :created_at, :updated_at)");
    $stmt->execute($user);
    $user['user_id'] = $this->connection->lastInsertId();
    return $user;
  }
  public function get_all_user()
  {
    $stmt = $this->connection->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll();
  }
}