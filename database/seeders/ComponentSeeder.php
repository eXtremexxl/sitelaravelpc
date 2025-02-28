<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Component;

class ComponentSeeder extends Seeder {
    public function run() {
        $components = [
            // Процессоры
            ['name' => 'Intel Core i3-10100F', 'category' => 'Процессор'],
            ['name' => 'Intel Core i3-12100F', 'category' => 'Процессор'],
            ['name' => 'Intel Core i5-10400F', 'category' => 'Процессор'],
            ['name' => 'Intel Core i5-12400F', 'category' => 'Процессор'],
            ['name' => 'Intel Core i5-13600K', 'category' => 'Процессор'],
            ['name' => 'Intel Core i7-13700K', 'category' => 'Процессор'],
            ['name' => 'Intel Core i9-13900K', 'category' => 'Процессор'],
            ['name' => 'Intel Core i9-14900K', 'category' => 'Процессор'],
            ['name' => 'AMD Ryzen 3 3100', 'category' => 'Процессор'],
            ['name' => 'AMD Ryzen 5 4500', 'category' => 'Процессор'],
            ['name' => 'AMD Ryzen 5 5500', 'category' => 'Процессор'],
            ['name' => 'AMD Ryzen 5 5600G', 'category' => 'Процессор'],
            ['name' => 'AMD Ryzen 5 5600X', 'category' => 'Процессор'],
            ['name' => 'AMD Ryzen 5 7600X', 'category' => 'Процессор'],
            ['name' => 'AMD Ryzen 7 7700X', 'category' => 'Процессор'],
            ['name' => 'AMD Ryzen 7 7800X', 'category' => 'Процессор'],
            ['name' => 'AMD Ryzen 9 7900X', 'category' => 'Процессор'],
            ['name' => 'AMD Ryzen 9 7950X', 'category' => 'Процессор'],

            // Видеокарты
            ['name' => 'NVIDIA GTX 1650 4GB', 'category' => 'Видеокарта'],
            ['name' => 'NVIDIA GTX 1660 Super 6GB', 'category' => 'Видеокарта'],
            ['name' => 'NVIDIA RTX 3050 8GB', 'category' => 'Видеокарта'],
            ['name' => 'NVIDIA RTX 3060 Ti', 'category' => 'Видеокарта'],
            ['name' => 'NVIDIA RTX 4060 Ti', 'category' => 'Видеокарта'],
            ['name' => 'NVIDIA RTX 4070 Ti', 'category' => 'Видеокарта'],
            ['name' => 'NVIDIA RTX 4080', 'category' => 'Видеокарта'],
            ['name' => 'NVIDIA RTX 4090', 'category' => 'Видеокарта'],
            ['name' => 'AMD Radeon RX 6500 XT 4GB', 'category' => 'Видеокарта'],
            ['name' => 'AMD Radeon RX 6600 8GB', 'category' => 'Видеокарта'],
            ['name' => 'AMD Radeon RX 6600 XT', 'category' => 'Видеокарта'],
            ['name' => 'AMD Radeon RX 6650 XT 8GB', 'category' => 'Видеокарта'],
            ['name' => 'AMD Radeon RX 6700 XT', 'category' => 'Видеокарта'],
            ['name' => 'AMD Radeon RX 7600', 'category' => 'Видеокарта'],
            ['name' => 'AMD Radeon RX 7700 XT', 'category' => 'Видеокарта'],
            ['name' => 'AMD Radeon RX 7800 XT', 'category' => 'Видеокарта'],
            ['name' => 'AMD Radeon RX 7900 XTX', 'category' => 'Видеокарта'],

            // Материнские платы
            ['name' => 'ASUS PRIME B450M-A', 'category' => 'Материнская плата'],
            ['name' => 'MSI B450M PRO-VDH', 'category' => 'Материнская плата'],
            ['name' => 'GIGABYTE B560M DS3H', 'category' => 'Материнская плата'],
            ['name' => 'ASRock A520M-HDV', 'category' => 'Материнская плата'],
            ['name' => 'ASUS ROG STRIX X670E', 'category' => 'Материнская плата'],
            ['name' => 'ASUS PRIME X570-PRO', 'category' => 'Материнская плата'],
            ['name' => 'MSI MAG B650 Tomahawk', 'category' => 'Материнская плата'],
            ['name' => 'GIGABYTE Z790 AORUS', 'category' => 'Материнская плата'],
            ['name' => 'ASRock B550 Steel Legend', 'category' => 'Материнская плата'],
            ['name' => 'ASUS TUF GAMING B660M', 'category' => 'Материнская плата'],

            // Оперативная память (ОЗУ)
            ['name' => 'Kingston Fury Beast 16GB DDR4 3200MHz', 'category' => 'ОЗУ'],
            ['name' => 'Crucial Ballistix 16GB DDR4 3600MHz', 'category' => 'ОЗУ'],
            ['name' => 'ADATA XPG 16GB DDR4 3000MHz', 'category' => 'ОЗУ'],
            ['name' => 'Corsair Vengeance 32GB DDR5 6000MHz', 'category' => 'ОЗУ'],
            ['name' => 'G.Skill Trident Z 64GB DDR5 6400MHz', 'category' => 'ОЗУ'],
            ['name' => 'Crucial Ballistix 32GB DDR4 3600MHz', 'category' => 'ОЗУ'],
            ['name' => 'Patriot Viper Steel 16GB DDR4 4000MHz', 'category' => 'ОЗУ'],
            ['name' => 'TEAMGROUP T-Force Delta RGB 32GB DDR5 6600MHz', 'category' => 'ОЗУ'],

            // Твердотельные накопители (SSD)
            ['name' => 'Kingston NV2 500GB NVMe', 'category' => 'SSD'],
            ['name' => 'Crucial P3 1TB NVMe', 'category' => 'SSD'],
            ['name' => 'WD Blue SN570 500GB NVMe', 'category' => 'SSD'],
            ['name' => 'Samsung 990 PRO 2TB', 'category' => 'SSD'],
            ['name' => 'Samsung 980 PRO 1TB', 'category' => 'SSD'],
            ['name' => 'Crucial P5 Plus 1TB', 'category' => 'SSD'],
            ['name' => 'WD Black SN850X 2TB', 'category' => 'SSD'],
            ['name' => 'Kingston KC3000 2TB', 'category' => 'SSD'],
            ['name' => 'ADATA XPG Gammix S70 1TB', 'category' => 'SSD'],

            // Жесткие диски (HDD)
            ['name' => 'Seagate Barracuda 1TB', 'category' => 'HDD'],
            ['name' => 'WD Blue 2TB', 'category' => 'HDD'],
            ['name' => 'Toshiba P300 1TB', 'category' => 'HDD'],
            ['name' => 'Seagate Barracuda 4TB', 'category' => 'HDD'],
            ['name' => 'WD Red 6TB', 'category' => 'HDD'],
            ['name' => 'Toshiba X300 8TB', 'category' => 'HDD'],
            ['name' => 'Seagate IronWolf 12TB', 'category' => 'HDD'],
            ['name' => 'WD Black 10TB', 'category' => 'HDD'],
            ['name' => 'Hitachi Ultrastar 14TB', 'category' => 'HDD'],

            // Блоки питания
            ['name' => 'Aerocool VX Plus 500W', 'category' => 'Блок питания'],
            ['name' => 'Deepcool PK550D 550W', 'category' => 'Блок питания'],
            ['name' => 'Cooler Master Elite V3 600W', 'category' => 'Блок питания'],
            ['name' => 'Corsair RM1000x 1000W', 'category' => 'Блок питания'],
            ['name' => 'Seasonic PRIME TX-850 850W', 'category' => 'Блок питания'],
            ['name' => 'MSI MPG A850GF 850W', 'category' => 'Блок питания'],
            ['name' => 'Cooler Master V850 SFX Gold', 'category' => 'Блок питания'],
            ['name' => 'Be Quiet! Dark Power 13 1000W', 'category' => 'Блок питания'],
            ['name' => 'EVGA SuperNOVA 1200 P3 1200W', 'category' => 'Блок питания'],
        ];

        foreach ($components as $component) {
            Component::create($component);
        }
    }
}