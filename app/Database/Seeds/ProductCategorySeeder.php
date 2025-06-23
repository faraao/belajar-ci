<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');
        
        // Merk-merk laptop populer
        $brands = ['Asus', 'Lenovo', 'HP', 'Dell', 'Acer', 'Apple', 'MSI', 'Toshiba', 'Samsung', 'Xiaomi'];
        
        // Data seri laptop contoh
        $series = [
            'Asus' => ['VivoBook 14', 'ZenBook 13', 'ROG Zephyrus', 'TUF Gaming'],
            'Lenovo' => ['ThinkPad X1', 'IdeaPad 3', 'Legion 5', 'Yoga Slim'],
            'HP' => ['Pavilion 15', 'Envy x360', 'Spectre x360', 'OMEN 15'],
            'Dell' => ['XPS 13', 'Inspiron 15', 'Alienware m15', 'Latitude 14'],
            'Acer' => ['Swift 3', 'Aspire 5', 'Predator Helios', 'Nitro 5'],
            'Apple' => ['MacBook Air', 'MacBook Pro 13"', 'MacBook Pro 16"'],
            'MSI' => ['Modern 14', 'Prestige 15', 'GF63 Thin', 'GS66 Stealth'],
            'Toshiba' => ['Portégé X30', 'Tecra X40', 'Satellite Pro'],
            'Samsung' => ['Galaxy Book Pro', 'Galaxy Book Flex'],
            'Xiaomi' => ['Mi Notebook Pro', 'RedmiBook 15']
        ];
        
        $product_category = [];
        
        for ($i = 0; $i < 20; $i++) {
            $brand = $brands[array_rand($brands)];
            $brandSeries = $series[$brand];
            $seri = $brandSeries[array_rand($brandSeries)];
            
            $product_category[] = [
                'merk'       => $brand,
                'seri'       => $seri,
                'harga'      => $faker->numberBetween(5000000, 25000000),
                'jumlah'     => $faker->numberBetween(1, 50),
                'spesifikasi' => $this->generateSpecs($brand, $seri),
                'foto'       => 'laptop-' . ($i + 1) . '.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        
        // Insert batch data dummy
        $this->db->table('product_category')->insertBatch($product_category);
    }
    
    protected function generateSpecs($brand, $seri)
    {
        $processors = [
            'Intel Core i3-1115G4',
            'Intel Core i5-1135G7', 
            'Intel Core i7-1165G7',
            'AMD Ryzen 3 5300U',
            'AMD Ryzen 5 5500U',
            'AMD Ryzen 7 5800U',
            'Apple M1',
            'Apple M1 Pro'
        ];
        
        $rams = ['4GB', '8GB', '16GB', '32GB'];
        $storages = ['256GB SSD', '512GB SSD', '1TB SSD', '1TB HDD + 256GB SSD'];
        $gpus = [
            'Intel Iris Xe',
            'NVIDIA GeForce MX450',
            'NVIDIA GeForce RTX 3050',
            'NVIDIA GeForce RTX 3060',
            'AMD Radeon Graphics',
            'Apple M1 7-core GPU'
        ];
        
        $os = [
            'Windows 10 Home',
            'Windows 11 Home',
            'macOS Monterey',
            'DOS'
        ];
        
        $specs = [
            'Processor' => $processors[array_rand($processors)],
            'RAM' => $rams[array_rand($rams)],
            'Penyimpanan' => $storages[array_rand($storages)],
            'GPU' => $gpus[array_rand($gpus)],
            'Sistem Operasi' => $os[array_rand($os)],
            'Layar' => '14" FHD IPS' . (strpos($seri, 'Pro') !== false ? ' 300nits' : ''),
            'Berat' => rand(12, 20) / 10 . ' kg'
        ];
        
        $specString = "Spesifikasi $brand $seri:\n";
        foreach ($specs as $key => $value) {
            $specString .= "- $key: $value\n";
        }
        
        return $specString;
    }
}
