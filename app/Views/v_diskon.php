<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-body pt-4">

        <?php
        $errors = session()->getFlashdata('errors');
        if ($errors) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '<strong>Gagal!</strong> Terjadi kesalahan validasi:<br>';
            foreach ($errors as $error) {
                echo esc($error) . '<br>';
            }
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
        $error = session()->getFlashdata('error');
        if ($error) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '<strong>Gagal!</strong> ' . esc($error);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
        ?>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('failed')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('failed'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            Tambah Data
        </button>

        <table class="table datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Nominal (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($diskons)) : ?>
                    <?php $no = 1; foreach ($diskons as $diskon) : ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= esc($diskon->tanggal) ?></td>
                            <td><?= 'IDR ' . number_format($diskon->nominal, 0, ',', '.') ?></td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-<?= $diskon->id ?>">
                                    Ubah
                                </button>
                                <a href="<?= base_url('diskon/delete/' . $diskon->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal-<?= $diskon->id ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="<?= base_url('diskon/update/' . $diskon->id) ?>" method="post">
                                        <?= csrf_field() ?>
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label for="tanggal">Tanggal</label>
                                                <input type="date" name="tanggal" class="form-control" value="<?= $diskon->tanggal ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="nominal">Diskon (Rp)</label>
                                                <input type="number" name="nominal" class="form-control" value="<?= $diskon->nominal ?>" required>
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
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Diskon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('diskon/create') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal (Rp)</label>
                        <input type="number" name="nominal" class="form-control" placeholder="Contoh: 100000" required>
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

<?= $this->endSection() ?>
