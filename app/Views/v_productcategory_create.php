<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product Category</title>
    <link rel="stylesheet" href="/NiceAdmin/assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Add Product Category</h2>
        <form action="/productcategory/create" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="merk" class="form-label">Merk</label>
                <input type="text" class="form-control" id="merk" name="merk" required>
            </div>
            <div class="mb-3">
                <label for="seri" class="form-label">Seri</label>
                <input type="text" class="form-control" id="seri" name="seri" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" step="0.01" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>
            <div class="mb-3">
                <label for="spesifikasi" class="form-label">Spesifikasi</label>
                <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
            <a href="/productcategory" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
