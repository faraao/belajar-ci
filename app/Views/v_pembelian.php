<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<h2>Manajemen Pembelian</h2>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="table-responsive">
<table class="table table-striped table-bordered" id="pembelianTable">
    <thead>
        <tr>
            <th>ID Pembelian</th>
            <th>Username</th>
            <th>Waktu Pembelian</th>
            <th>Total Bayar</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $transaction): ?>
        <tr>
            <td><?= $transaction['id'] ?></td>
            <td><?= esc($transaction['username']) ?></td>
            <td><?= $transaction['created_at'] ?></td>
            <td><?= 'IDR ' . number_format($transaction['total_harga'], 0, ',', '.') ?></td>
            <td><?= esc($transaction['alamat']) ?></td>
            <td>
                <?php if ($transaction['status'] == 1): ?>
                    <span class="badge bg-success">Sudah Selesai</span>
                <?php else: ?>
                    <span class="badge bg-danger">Belum Selesai</span>
                <?php endif; ?>
            </td>
            <td>
                <a href="/pembelian/updateStatus/<?= $transaction['id'] ?>" class="btn btn-warning btn-sm">Ubah Status</a>
                <a href="/pembelian/detail/<?= $transaction['id'] ?>" class="btn btn-success btn-sm">Detail</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<?= $this->endSection() ?>
