<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - TOKO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-header {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .table-container {
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 0.375rem;
            box-shadow: 0 0.0625rem 0.125rem rgba(0, 0, 0, 0.1);
            margin-top: 1rem;
        }
        .table {
            margin-bottom: 0;
            font-size: 13px;
        }
        .table thead th {
            font-weight: 600;
            border-bottom: 1px solid #dee2e6;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        .table tbody td {
            padding-top: 0.4rem;
            padding-bottom: 0.4rem;
            vertical-align: middle;
            text-align: left;
            border-top: none;
        }
        .table tbody tr:not(:last-child) {
            border-bottom: 1px solid #dee2e6;
        }
        .table th:first-child, .table td:first-child {
            text-align: center;
        }
    </style>
  </head>
  <body>
    <?php 
    function curl() {
    $apiUrl = "http://localhost:8080/api";
    $apiKey = "superrahasia123";

    $headers = [
        "Authorization: Bearer {$apiKey}"
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => "http://localhost:8080/api",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-API-KEY: superrahasia123"
    ]
]);
    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $error = curl_error($curl);
    curl_close($curl);

    if ($error) {
        return (object)[
            'results' => [],
            'status' => [
                'code' => 500,
                'description' => "cURL error: $error"
            ]
        ];
    }

    if ($httpCode !== 200) {
        return (object)[
            'results' => [],
            'status' => [
                'code' => $httpCode,
                'description' => "Unexpected HTTP status code: $httpCode",
                'raw_response' => $response
            ]
        ];
    }

    return json_decode($response);
}
    ?>
    <div class="container">
        <div class="dashboard-header text-center">
            <h1 class="display-5 fw-normal text-body-emphasis">Dashboard - TOKO</h1>
            <p class="fs-5 text-body-secondary" id="currentDateTime"></p>
        </div> 

        <div class="table-container">
            <h4 class="mb-4">Transaksi Pembelian</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Alamat</th>
                            <th>Total Harga</th>
                            <th>Ongkir</th>
                            <th>Status</th>
                            <th>Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $send1 = curl();
                            if (is_object($send1) && property_exists($send1, 'status') && is_object($send1->status) && $send1->status->code == 200) {
                                $hasil1 = $send1->results;
                                $i = 1; 

                                if(!empty($hasil1)){
                                    foreach($hasil1 as $item1){ 
                        ?>
                                        <tr>
                                            <td class="text-center"><?= $i++ ?></td>
                                            <td><?= $item1->username; ?></td>
                                            <td><?= $item1->alamat; ?></td>
                                            <td>
                                                <?= number_format($item1->total_harga, 0, ',', '.') ?>
                                                <br>
                                                <small class="text-muted">(<?= $item1->jumlah_item ?? 0; ?> item)</small>
                                            </td>
                                            <td><?= number_format($item1->ongkir, 0, ',', '.') ?></td>
                                            <td>
                                                <?php if ($item1->status == 0) : ?>
                                                    <span class="text-danger">Belum Selesai</span>
                                                <?php else : ?>
                                                    <span class="text-success">Sudah Selesai</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $item1->created_at; ?></td>
                                        </tr> 
                        <?php
                                    } 
                                } else {
                                    echo '<tr><td colspan="7" class="text-center">Tidak ada data transaksi.</td></tr>';
                                }
                            } else {
                                echo '<tr><td colspan="7" class="text-center">Tidak ada data atau gagal mengambil data dari API.</td></tr>';
                            }
                        ?> 
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function updateDateTime() {
            const now = new Date();
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const dayName = days[now.getDay()];
            const day = String(now.getDate()).padStart(2, '0');
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const year = now.getFullYear();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const formatted = `${dayName}, ${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
            document.getElementById('currentDateTime').textContent = formatted;
        }
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
  </body>
</html>
