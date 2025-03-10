<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('components', function (Blueprint $table) {
            $table->string('socket')->nullable()->after('category'); // Сокет для процессора и материнки
            $table->integer('power')->nullable()->after('socket');   // Энергопотребление или мощность БП
            $table->integer('capacity')->nullable()->after('power'); // Объем для ОЗУ, SSD, HDD
            $table->decimal('price', 10, 2)->default(0)->after('capacity'); // Цена
            $table->string('image')->nullable()->after('price');     // Изображение
        });
    }

    public function down() {
        Schema::table('components', function (Blueprint $table) {
            $table->dropColumn(['socket', 'power', 'capacity', 'price', 'image']);
        });
    }
};