<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
    Tambah Data
</button>

<table class="table datatable mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Merk</th>
            <th>Seri</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Spesifikasi</th>
            <th>Foto</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $index => $category) : ?>
            <tr>
                <th scope="row"><?= $index + 1 ?></th>
                <td><?= esc($category['merk']) ?></td>
                <td><?= esc($category['seri']) ?></td>
                <td><?= number_format($category['harga'], 2, ',', '.') ?></td>
                <td><?= esc($category['jumlah']) ?></td>
                <td><pre><?= esc($category['spesifikasi']) ?></pre></td>
                <td>
                    <?php if ($category['foto'] && file_exists('img/' . $category['foto'])) : ?>
                        <img src="/img/<?= esc($category['foto']) ?>" width="100">
                    <?php endif; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-<?= $category['id'] ?>">
                        Ubah
                    </button>
                    <a href="<?= base_url('productcategory/delete/' . $category['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini ?')">
                        Hapus
                    </a>
                </td>
            </tr>

            <!-- Edit Modal Begin -->
            <div class="modal fade" id="editModal-<?= $category['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('productcategory/edit/' . $category['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Merk</label>
                                    <input type="text" name="merk" class="form-control" value="<?= esc($category['merk']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Seri</label>
                                    <input type="text" name="seri" class="form-control" value="<?= esc($category['seri']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" name="harga" class="form-control" value="<?= esc($category['harga']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="text" name="jumlah" class="form-control" value="<?= esc($category['jumlah']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Spesifikasi</label>
                                    <textarea name="spesifikasi" class="form-control" rows="4"><?= esc($category['spesifikasi']) ?></textarea>
                                </div>
                                <img src="<?= base_url('img/' . $category['foto']) ?>" width="100px">
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox" id="check" name="check" value="1">
                                    <label class="form-check-label" for="check">
                                        Ceklis jika ingin mengganti foto
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto" accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Modal End -->

        <?php endforeach; ?>
    </tbody>
</table>

<!-- Add Modal Begin -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('productcategory') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Merk</label>
                        <input type="text" name="merk" class="form-control" placeholder="Merk" required>
                    </div>
                    <div class="form-group">
                        <label>Seri</label>
                        <input type="text" name="seri" class="form-control" placeholder="Seri" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="harga" class="form-control" placeholder="Harga" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" placeholder="Jumlah" required>
                    </div>
                    <div class="form-group">
                        <label>Spesifikasi</label>
                        <textarea name="spesifikasi" class="form-control" rows="4" placeholder="Spesifikasi"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Modal End -->

<?= $this->endSection() ?>
