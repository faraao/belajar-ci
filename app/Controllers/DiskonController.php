<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiskonModel;

class DiskonController extends BaseController
{
    protected $diskonModel;

    public function __construct()
    {
        helper(['form', 'number']);
        $this->diskonModel = new DiskonModel();
    }

    public function index()
    {
        $data = ['diskons' => $this->diskonModel->findAll()];
        return view('v_diskon', $data);
    }

    public function create()
    {
        $rules = [
            'tanggal' => 'required|is_unique[diskon.tanggal]',
            'nominal' => 'required|numeric'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->diskonModel->save([
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
        ]);
        return redirect()->to('/diskon')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Memproses pembaruan data diskon dari modal.
     */
    public function update($id)
    {
        // Validasi hanya untuk nominal karena tanggal readonly
        $rules = [
            'nominal' => 'required|numeric'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->to('/diskon')->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nominal' => $this->request->getPost('nominal')
        ];

        $this->diskonModel->update($id, $data);

        return redirect()->to('/diskon')->with('success', 'Data diskon berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->diskonModel->delete($id);
        return redirect()->to('/diskon')->with('success', 'Data berhasil dihapus.');
    }
}
