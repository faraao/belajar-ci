<?php

namespace App\Controllers;

use App\Models\ProductCategoryModel;

class ProductCategoryController extends BaseController
{
    protected $productCategory;

    public function __construct()
    {
        $this->productCategory = new ProductCategoryModel();
    }

    public function index()
    {
        $data['categories'] = $this->productCategory->findAll();
        return view('v_productcategory', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $dataFoto = $this->request->getFile('foto');

            $dataForm = [
                'merk' => $this->request->getPost('merk'),
                'seri' => $this->request->getPost('seri'),
                'harga' => $this->request->getPost('harga'),
                'jumlah' => $this->request->getPost('jumlah'),
                'spesifikasi' => $this->request->getPost('spesifikasi'),
                'created_at' => date("Y-m-d H:i:s")
            ];

            if ($dataFoto && $dataFoto->isValid() && !$dataFoto->hasMoved()) {
                $fileName = $dataFoto->getRandomName();
                $dataFoto->move('img/', $fileName);
                $dataForm['foto'] = $fileName;
            }

            $this->productCategory->save($dataForm);
            return redirect()->to('/productcategory')->with('success', 'Data berhasil ditambahkan.');
        }

        return redirect()->to('/productcategory');
    }

    public function edit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $category = $this->productCategory->find($id);
            if (!$category) {
                return redirect()->to('/productcategory')->with('error', 'Data tidak ditemukan.');
            }

            $dataForm = [
                'id' => $id,
                'merk' => $this->request->getPost('merk'),
                'seri' => $this->request->getPost('seri'),
                'harga' => $this->request->getPost('harga'),
                'jumlah' => $this->request->getPost('jumlah'),
                'spesifikasi' => $this->request->getPost('spesifikasi'),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            if ($this->request->getPost('check')) {
                $dataFoto = $this->request->getFile('foto');
                if ($dataFoto && $dataFoto->isValid() && !$dataFoto->hasMoved()) {
                    if ($category['foto'] && file_exists('img/' . $category['foto'])) {
                        unlink('img/' . $category['foto']);
                    }
                    $fileName = $dataFoto->getRandomName();
                    $dataFoto->move('img/', $fileName);
                    $dataForm['foto'] = $fileName;
                }
            }

            $this->productCategory->save($dataForm);
            return redirect()->to('/productcategory')->with('success', 'Data berhasil diubah.');
        }

        return redirect()->to('/productcategory');
    }

    public function delete($id)
    {
        $category = $this->productCategory->find($id);

        if ($category) {
            if ($category['foto'] && file_exists('img/' . $category['foto'])) {
                unlink('img/' . $category['foto']);
            }
            $this->productCategory->delete($id);
            return redirect()->to('/productcategory')->with('success', 'Data berhasil dihapus.');
        }

        return redirect()->to('/productcategory')->with('error', 'Data tidak ditemukan.');
    }
}
