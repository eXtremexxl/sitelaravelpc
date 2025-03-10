<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('components', function (Blueprint $table) {
            // Для материнских плат и корпусов
            $table->enum('form_factor', ['ATX', 'Micro-ATX', 'Mini-ITX'])->nullable()->after('category');
            $table->integer('memory_slots')->nullable()->after('capacity'); // Кол-во слотов ОЗУ
            $table->integer('max_memory_freq')->nullable()->after('memory_slots'); // Макс. частота ОЗУ
            $table->string('pcie_version')->nullable()->after('max_memory_freq'); // Версия PCIe

            // Для корпусов
            $table->integer('max_gpu_length')->nullable()->after('pcie_version'); // Макс. длина видеокарты
            $table->integer('max_psu_length')->nullable()->after('max_gpu_length'); // Макс. длина БП

            // Для процессоров и кулеров
            $table->integer('tdp')->nullable()->after('power'); // TDP для CPU и кулеров

            // Для ОЗУ
            $table->integer('frequency')->nullable()->after('capacity'); // Частота ОЗУ

            // Дополнительно
            $table->integer('benchmark_score')->nullable()->after('price'); // Оценка производительности
        });

        // Таблица для сохраненных сборок
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->json('components'); // Список ID комплектующих
            $table->string('name')->default('Моя сборка');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::table('components', function (Blueprint $table) {
            $table->dropColumn([
                'form_factor', 'memory_slots', 'max_memory_freq', 'pcie_version',
                'max_gpu_length', 'max_psu_length', 'tdp', 'frequency', 'benchmark_score'
            ]);
        });
        Schema::dropIfExists('configurations');
    }
};