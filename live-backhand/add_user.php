<?php
require_once __DIR__ . '/rest/services/UserService.class.php';

if($payload['email'] == NULL || $payload['email'] == NULL){
    header('HTTP/1.1 500 Bad Request');
    die(json_encode(['error' => "Email field is missing"]));
}

$user_service = new UserService();
$user_service->add_user($payload);

echo json_encode(['message' => "Succesful", 'data' => $user]);