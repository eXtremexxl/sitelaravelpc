<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Component;

class ComponentSeeder extends Seeder {
    public function run() {
        $components = [

            // 💰 Бюджетные процессоры AMD
            ['name' => 'AMD Ryzen 3 3100', 'category' => 'Процессор'],
            ['name' => 'AMD Ryzen 5 4500', 'category' => 'Процессор'],
            ['name' => 'AMD Ryzen 5 5500', 'category' => 'Процессор'],
            ['name' => 'AMD Ryzen 5 5600G', 'category' => 'Процессор'],

            // 💰 Бюджетные видеокарты NVIDIA
            ['name' => 'NVIDIA GTX 1650 4GB', 'category' => 'Видеокарта'],
            ['name' => 'NVIDIA GTX 1660 Super 6GB', 'category' => 'Видеокарта'],
            ['name' => 'NVIDIA RTX 3050 8GB', 'category' => 'Видеокарта'],

            // 💰 Бюджетные видеокарты AMD
            ['name' => 'AMD Radeon RX 6500 XT 4GB', 'category' => 'Видеокарта'],
            ['name' => 'AMD Radeon RX 6600 8GB', 'category' => 'Видеокарта'],
            ['name' => 'AMD Radeon RX 6650 XT 8GB', 'category' => 'Видеокарта'],

            // 💰 Бюджетные материнские платы
            ['name' => 'ASUS PRIME B450M-A', 'category' => 'Материнская плата'],
            ['name' => 'MSI B450M PRO-VDH', 'category' => 'Материнская плата'],
            ['name' => 'GIGABYTE B560M DS3H', 'category' => 'Материнская плата'],
            ['name' => 'ASRock A520M-HDV', 'category' => 'Материнская плата'],

            // 💰 Бюджетная оперативная память
            ['name' => 'Kingston Fury Beast 16GB DDR4 3200MHz', 'category' => 'ОЗУ'],
            ['name' => 'Crucial Ballistix 16GB DDR4 3600MHz', 'category' => 'ОЗУ'],
            ['name' => 'ADATA XPG 16GB DDR4 3000MHz', 'category' => 'ОЗУ'],

            // 💰 Бюджетные SSD
            ['name' => 'Kingston NV2 500GB NVMe', 'category' => 'SSD'],
            ['name' => 'Crucial P3 1TB NVMe', 'category' => 'SSD'],
            ['name' => 'WD Blue SN570 500GB NVMe', 'category' => 'SSD'],

            // 💰 Бюджетные HDD
            ['name' => 'Seagate Barracuda 1TB', 'category' => 'HDD'],
            ['name' => 'WD Blue 2TB', 'category' => 'HDD'],
            ['name' => 'Toshiba P300 1TB', 'category' => 'HDD'],

            // 💰 Бюджетные блоки питания
            ['name' => 'Aerocool VX Plus 500W', 'category' => 'Блок питания'],
            ['name' => 'Deepcool PK550D 550W', 'category' => 'Блок питания'],
            ['name' => 'Cooler Master Elite V3 600W', 'category' => 'Блок питания'],
        ];

        foreach ($components as $component) {
            Component::create($component);
        }
    }
}
