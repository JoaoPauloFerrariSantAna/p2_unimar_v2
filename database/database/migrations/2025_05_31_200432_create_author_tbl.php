<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

require_once __DIR__ . "/../../constants/data_sizes.php";

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('author_tbl', function (Blueprint $table) {
            $table->id();
			$table->string("name", FIELD_SIZE_DEFAULT_MAX);
			$table->string("biograph", FIELD_SIZE_DESCRIPTION);
			$table->dateTime("birthday");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('author_tbl');
    }
};
