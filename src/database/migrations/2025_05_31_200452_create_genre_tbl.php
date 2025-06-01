<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

require_once __DIR__ . "/../../constants/data_sizes.php";

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('genre_tbl', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('genre_tbl');
    }
};
