<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product Category</title>
    <link rel="stylesheet" href="/NiceAdmin/assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Product Category</h2>
        <form action="/productcategory/edit/<?= esc($category['id']) ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="merk" class="form-label">Merk</label>
                <input type="text" class="form-control" id="merk" name="merk" value="<?= esc($category['merk']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="seri" class="form-label">Seri</label>
                <input type="text" class="form-control" id="seri" name="seri" value="<?= esc($category['seri']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" step="0.01" class="form-control" id="harga" name="harga" value="<?= esc($category['harga']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= esc($category['jumlah']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="spesifikasi" class="form-label">Spesifikasi</label>
                <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="4"><?= esc($category['spesifikasi']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <?php if ($category['foto'] && file_exists('img/' . $category['foto'])): ?>
                    <div class="mb-2">
                        <img src="/img/<?= esc($category['foto']) ?>" alt="Foto" width="150">
                    </div>
                <?php endif; ?>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
            <a href="/productcategory" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
