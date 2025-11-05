const apiUrl = "../api/products.php";
const form = document.getElementById("productForm");
const table = document.getElementById("productTable");
const resetBtn = document.getElementById("resetBtn");
let editId = null;

// 🔹 Load data
async function loadProducts() {
  const res = await fetch(apiUrl);
  const data = await res.json();
  table.innerHTML = data
    .map(
      (p) => `
      <tr>
        <td>${p.id}</td>
        <td>${p.name}</td>
        <td>Rp ${p.price.toLocaleString()}</td>
        <td>
          <button class="btn btn-sm btn-warning" onclick="editProduct(${p.id}, '${p.name}', ${p.price})">✏️ Edit</button>
          <button class="btn btn-sm btn-danger" onclick="deleteProduct(${p.id})">🗑️ Hapus</button>
        </td>
      </tr>`
    )
    .join("");
}

// 🔹 Tambah / update data
form.addEventListener("submit", async (e) => {
  e.preventDefault();
  const data = {
    id: editId,
    name: form.name.value,
    price: Number(form.price.value),
  };

  await fetch(apiUrl, {
    method: editId ? "PATCH" : "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data),
  });

  editId = null;
  form.reset();
  loadProducts();
});

// 🔹 Edit produk
function editProduct(id, name, price) {
  editId = id;
  form.name.value = name;
  form.price.value = price;
}

// 🔹 Hapus produk
async function deleteProduct(id) {
  if (!confirm("Yakin hapus produk ini?")) return;
  await fetch(apiUrl, {
    method: "DELETE",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id }),
  });
  loadProducts();
}

resetBtn.addEventListener("click", () => (editId = null));

loadProducts();
