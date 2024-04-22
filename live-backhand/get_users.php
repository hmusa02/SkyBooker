<?php
require_once __DIR__ . '/rest/services/UserService.class.php';

$payload = $_REQUEST;

$params = [
  'start' => (int)$payload['start'],
  'search' => (int)$payload['search']['value'],
  'draw' => (int)$payload['draw'],
  'limit' => (int)$payload['length'],
  'order_column' => (int)$payload['start'][0]['name'],
  'order_direction' => (int)$payload['order'][0]['dir'],
];

$user_service = new UserService();

$data = $user_service->get_users_paginated($params['start'], $params['limit'], $params['search'], $params['order_colimn'], $params['order_direction']);


echo json_encode([
  'draw' => $params['draw'],
  'data' => $data,
  'recordsFiltered' => $data['count'],
  'recordsTotal' => $data['count'],
  'end' => $data['count']
]);