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

            if ($dataFoto && $dataFoto->isValid()) {
                $fileName = $dataFoto->getRandomName();
                $dataForm['foto'] = $fileName;
                $dataFoto->move('img/', $fileName);
            }

            $this->productCategory->insert($dataForm);

            return redirect()->to('/productcategory')->with('success', 'Product Category added successfully');
        }

        return view('v_productcategory_create');
    }

    public function edit($id)
    {
        $category = $this->productCategory->find($id);

        if (!$category) {
            return redirect()->to('/productcategory')->with('error', 'Product Category not found');
        }

        if ($this->request->getMethod() === 'post') {
            $dataFoto = $this->request->getFile('foto');

            $dataForm = [
                'merk' => $this->request->getPost('merk'),
                'seri' => $this->request->getPost('seri'),
                'harga' => $this->request->getPost('harga'),
                'jumlah' => $this->request->getPost('jumlah'),
                'spesifikasi' => $this->request->getPost('spesifikasi'),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            if ($dataFoto && $dataFoto->isValid()) {
                if ($category['foto'] && file_exists('img/' . $category['foto'])) {
                    unlink('img/' . $category['foto']);
                }
                $fileName = $dataFoto->getRandomName();
                $dataFoto->move('img/', $fileName);
                $dataForm['foto'] = $fileName;
            }

            $this->productCategory->update($id, $dataForm);

            return redirect()->to('/productcategory')->with('success', 'Product Category updated successfully');
        }

        $data['category'] = $category;
        return view('v_productcategory_edit', $data);
    }

    public function delete($id)
    {
        $category = $this->productCategory->find($id);

        if ($category) {
            if ($category['foto'] && file_exists('img/' . $category['foto'])) {
                unlink('img/' . $category['foto']);
            }
            $this->productCategory->delete($id);
            return redirect()->to('/productcategory')->with('success', 'Product Category deleted successfully');
        }

        return redirect()->to('/productcategory')->with('error', 'Product Category not found');
    }
}
