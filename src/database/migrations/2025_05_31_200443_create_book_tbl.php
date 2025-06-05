<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

require_once __DIR__ . "/../../constants/data_sizes.php";

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_tbl', function (Blueprint $table) {
            $table->id();
			$table->string("title", FIELD_SIZE_DEFAULT_MAX);
			$table->string("summary", FIELD_SIZE_DESCRIPTION);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_tbl');
    }
};
