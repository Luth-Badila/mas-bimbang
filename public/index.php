<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP + Bootstrap + Supabase CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="text-center mb-4">📦 CRUD Produk (PHP + Supabase)</h2>

    <div class="card p-3 mb-4">
      <form id="productForm">
        <input type="hidden" id="id">
        <div class="mb-3">
          <label class="form-label">Nama Produk</label>
          <input type="text" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Harga</label>
          <input type="number" id="price" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
        <button type="reset" class="btn btn-secondary" id="resetBtn">Reset</button>
      </form>
    </div>

    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="productTable"></tbody>
    </table>
  </div>

  <script src="./script.js"></script>
</body>
</html>
