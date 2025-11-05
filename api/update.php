<?php
include 'db.php';
$data = readData();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  foreach ($data as &$item) {
    if ($item['id'] == $_POST['id']) {
      $item['name'] = $_POST['name'];
      $item['price'] = $_POST['price'];
    }
  }
  saveData($data);
  header("Location: index.php");
  exit;
}

$id = $_GET['id'] ?? null;
$item = null;
foreach ($data as $d) {
  if ($d['id'] == $id) $item = $d;
}
if (!$item) {
  echo "Data tidak ditemukan.";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h1 class="mb-4 text-center">Edit Barang</h1>
  <form method="POST">
    <input type="hidden" name="id" value="<?= $item['id'] ?>">
    <div class="mb-3">
      <label>Nama Barang</label>
      <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Harga</label>
      <input type="number" name="price" value="<?= htmlspecialchars($item['price']) ?>" class="form-control" required>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>
</body>
</html>
