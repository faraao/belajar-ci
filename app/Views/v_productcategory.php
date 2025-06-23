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
            <div class="modal fade" id="editModal-<?= $category['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel-<?= $category['id'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel-<?= $category['id'] ?>">Edit Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('productcategory/edit/' . $category['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="merk-<?= $category['id'] ?>" class="form-label">Merk</label>
                                    <input type="text" class="form-control" id="merk-<?= $category['id'] ?>" name="merk" value="<?= esc($category['merk']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="seri-<?= $category['id'] ?>" class="form-label">Seri</label>
                                    <input type="text" class="form-control" id="seri-<?= $category['id'] ?>" name="seri" value="<?= esc($category['seri']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga-<?= $category['id'] ?>" class="form-label">Harga</label>
                                    <input type="number" step="0.01" class="form-control" id="harga-<?= $category['id'] ?>" name="harga" value="<?= esc($category['harga']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah-<?= $category['id'] ?>" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah-<?= $category['id'] ?>" name="jumlah" value="<?= esc($category['jumlah']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="spesifikasi-<?= $category['id'] ?>" class="form-label">Spesifikasi</label>
                                    <textarea class="form-control" id="spesifikasi-<?= $category['id'] ?>" name="spesifikasi" rows="4"><?= esc($category['spesifikasi']) ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="foto-<?= $category['id'] ?>" class="form-label">Foto</label>
                                    <?php if ($category['foto'] && file_exists('img/' . $category['foto'])) : ?>
                                        <div class="mb-2">
                                            <img src="/img/<?= esc($category['foto']) ?>" alt="Foto" width="150">
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" class="form-control" id="foto-<?= $category['id'] ?>" name="foto" accept="image/*">
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
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('productcategory/create') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
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
