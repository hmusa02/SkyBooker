<?php

require_once __DIR__ . '/rest/services/UserService.class.php';

$employee_service = new UserService();

$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);

$result = $user_service->add_user([
  "user_id" => $decoded['user_id'],
  "username" => $decoded['username'],
  "password_hash" => $decoded['password_hash'],
  "email" => $decoded['email'],
  "full_name" => $decoded['full_name'],
  "date_of_birth" => $decoded['date_of_birth'],
  "created_at" => $decoded['created_at'],
  "updated_at" => $decoded['updated_at']
]);

header('Content-Type: application/json');
if ($result) {
  echo json_encode($result);
} else {
  echo json_encode(["error" => "Failed to add user."]);
}