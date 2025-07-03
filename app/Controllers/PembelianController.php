<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class PembelianController extends BaseController
{
    protected $transaction;

    public function __construct()
    {
        $this->transaction = new TransactionModel();
        helper('form');

        // Role-based access control: only admin allowed
        if (session('role') !== 'admin') {
            redirect()->to('/')->with('error', 'Akses hanya untuk admin')->send();
            exit;
        }
    }

    public function index()
    {
        $data['transactions'] = $this->transaction->orderBy('created_at', 'DESC')->findAll();
        return view('v_pembelian', $data);
    }

    public function updateStatus($id)
    {
        $transaction = $this->transaction->find($id);
        if (!$transaction) {
            return redirect()->to('/pembelian')->with('error', 'Data pembelian tidak ditemukan.');
        }

        $newStatus = $transaction['status'] == 0 ? 1 : 0;
        $this->transaction->update($id, ['status' => $newStatus, 'updated_at' => date('Y-m-d H:i:s')]);

        return redirect()->to('/pembelian')->with('success', 'Status pesanan berhasil diubah.');
    }
}
