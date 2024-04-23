<?php

require_once __DIR__ . '/rest/services/UserService.class.php';

$user_service = new UserService();

$user = $user_service->get_all_user();

header('Content-Type: application/json');
echo json_encode(array("data" => $user));