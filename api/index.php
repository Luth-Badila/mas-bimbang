<?php
include 'db.php';
$items = readData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP CRUD on Vercel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    async function deleteItem(id) {
      if (!confirm("Yakin ingin menghapus data ini?")) return;
      await fetch("delete.php?id=" + id);
      location.reload();
    }
  </script>
</head>
<body class="bg-light">
<div class="container mt-5">
  <h1 class="mb-4 text-center">CRUD PHP + Bootstrap + JS (Vercel)</h1>

  <!-- FORM TAMBAH DATA -->
  <form action="create.php" method="POST" class="mb-4">
    <div class="row g-3 align-items-center">
      <div class="col-md-4">
        <input name="name" required class="form-control" placeholder="Nama Barang">
      </div>
      <div class="col-md-4">
        <input name="price" required type="number" class="form-control" placeholder="Harga">
      </div>
      <div class="col-md-4">
        <button class="btn btn-primary w-100">Tambah</button>
      </div>
    </div>
  </form>

  <!-- TABEL DATA -->
  <table class="table table-striped table-bordered text-center">
    <thead class="table-dark">
      <tr>
        <th>ID</th><th>Nama</th><th>Harga</th><th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $item): ?>
      <tr>
        <td><?= htmlspecialchars($item['id']) ?></td>
        <td><?= htmlspecialchars($item['name']) ?></td>
        <td><?= htmlspecialchars($item['price']) ?></td>
        <td>
          <a href="update.php?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <button onclick="deleteItem(<?= $item['id'] ?>)" class="btn btn-danger btn-sm">Hapus</button>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
