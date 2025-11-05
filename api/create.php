<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = readData();
  $id = count($data) ? end($data)['id'] + 1 : 1;
  $new = [
    'id' => $id,
    'name' => $_POST['name'],
    'price' => $_POST['price']
  ];
  $data[] = $new;
  saveData($data);
}

header("Location: index.php");
exit;
