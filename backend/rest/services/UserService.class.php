<?php

require_once __DIR__ . '/../dao/UserDao.class.php';

class UserService {
    private $user_dao;
    
    public function __construct() {
        $this->user_dao = new UserDao();
    }

    public function get_all_users() {
        return $this->user_dao->get_all_users();
    }

    public function get_user_by_id($user_id) {
        return $this->user_dao->get_user_by_id($user_id);
    }

    public function add_user($user) {
        return $this->user_dao->add_user($user);
    }

    public function update_user($user_id, $user) {
        return $this->user_dao->edit_user($user_id, $user);
    }

    public function delete_user($user_id) {
        return $this->user_dao->delete_user_by_id($user_id);
    }
}
?>
