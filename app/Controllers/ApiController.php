<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

use App\Models\UserModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class ApiController extends ResourceController
{
    protected $apiKey;
    protected $user;
    protected $transaction;
    protected $transaction_detail;

    function __construct()
    {
        $this->apiKey = "superrahasia123";
        $this->user = new UserModel();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
{
    $headerKey = $this->request->getHeaderLine('X-API-KEY'); // ← ini kuncinya
    $expectedKey = $this->apiKey;

    if ($headerKey === $expectedKey) {
        $builder = $this->transaction->builder(); 
        $builder->select('transaction.*, SUM(transaction_detail.jumlah) as jumlah_item');
        $builder->join('transaction_detail', 'transaction_detail.transaction_id = transaction.id', 'left');
        $builder->groupBy('transaction.id');
        $penjualan = $builder->get()->getResult();

        $count = count($penjualan);

        return $this->respond([
            'results' => $penjualan,
            'count' => $count,
            'status' => ['code' => 200, 'description' => 'OK']
        ]);
    }

    return $this->respond([
        'results' => [],
        'status' => [
            'code' => 401,
            'description' => 'Unauthorized',
            'debug_received' => $headerKey,
            'debug_expected' => $expectedKey
        ]
    ]);
}
    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        // Tidak digunakan
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        // Tidak digunakan
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        // Tidak digunakan
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        // Tidak digunakan
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        // Tidak digunakan
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        // Tidak digunakan
    }
}
