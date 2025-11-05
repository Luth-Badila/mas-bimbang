<?php
include 'db.php';

$id = $_GET['id'] ?? null;
if ($id) {
  $data = readData();
  $data = array_filter($data, fn($item) => $item['id'] != $id);
  saveData(array_values($data));
}

header("Location: index.php");
exit;
