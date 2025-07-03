<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiskonSeeder extends Seeder
{
    public function run()
    {
        $diskons = [];
        $startDate = date('Y-m-d');

        for ($i = 0; $i < 10; $i++) {
            $tanggal = date('Y-m-d', strtotime("+$i day", strtotime($startDate)));
            $diskons[] = [
                'tanggal' => $tanggal,
                'nominal' => rand(50000, 200000),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('diskon')->insertBatch($diskons);
    }
}
