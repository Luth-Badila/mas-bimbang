<?php
header("Content-Type: application/json");

$apiUrl = "https://uhqkmkwguctctqsdomrf.supabase.co/rest/v1/products";
$apiKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InVocWtta3dndWN0Y3Rxc2RvbXJmIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTQ5NzEyNjgsImV4cCI6MjA3MDU0NzI2OH0.zp3Y4WG40ibfhOahrhQE5315wqoEJcivrpHK--iT7t4";

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
  case 'GET':
    $opts = [
      "http" => [
        "header" => "apikey: $apiKey\r\nAuthorization: Bearer $apiKey\r\n",
        "method" => "GET"
      ]
    ];
    break;

  case 'POST':
    $data = [
      "name" => $input["name"] ?? "",
      "price" => $input["price"] ?? 0
    ];
    $opts = [
      "http" => [
        "header" => "apikey: $apiKey\r\nAuthorization: Bearer $apiKey\r\nContent-Type: application/json\r\nPrefer: return=representation\r\n",
        "method" => "POST",
        "content" => json_encode($data)
      ]
    ];
    break;

  case 'PATCH':
    $id = $input["id"] ?? null;
    if (!$id) { echo json_encode(["error" => "Missing ID"]); exit; }
    $data = [
      "name" => $input["name"] ?? "",
      "price" => $input["price"] ?? 0
    ];
    $opts = [
      "http" => [
        "header" => "apikey: $apiKey\r\nAuthorization: Bearer $apiKey\r\nContent-Type: application/json\r\nPrefer: return=representation\r\n",
        "method" => "PATCH",
        "content" => json_encode($data)
      ]
    ];
    $apiUrl .= "?id=eq.$id";
    break;

  case 'DELETE':
    $id = $input["id"] ?? null;
    if (!$id) { echo json_encode(["error" => "Missing ID"]); exit; }
    $opts = [
      "http" => [
        "header" => "apikey: $apiKey\r\nAuthorization: Bearer $apiKey\r\n",
        "method" => "DELETE"
      ]
    ];
    $apiUrl .= "?id=eq.$id";
    break;

  default:
    echo json_encode(["error" => "Invalid method"]);
    exit;
}

$context = stream_context_create($opts);
$response = file_get_contents($apiUrl, false, $context);

echo $response ?: json_encode(["status" => "ok"]);
