<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Название комплектующего
            $table->enum('category', ['Процессор', 'Видеокарта', 'Материнская плата', 'ОЗУ', 'SSD', 'HDD', 'Блок питания', 'Корпус', 'Кулер']);
            $table->timestamps();
        });

        // Промежуточная таблица для связи ПК и комплектующих
        Schema::create('component_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('component_id')->constrained()->onDelete('cascade');
            
        });
    }

    public function down() {
        Schema::dropIfExists('component_product');
        Schema::dropIfExists('components');
    }
};
