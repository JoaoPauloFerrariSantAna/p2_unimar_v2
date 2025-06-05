<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

require_once __DIR__."/../../constants/data_sizes.php";

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_tbl', function (Blueprint $table) {
            $table->id();
			$table->string("username", FIELD_SIZE_DEFAULT_MAX);
			$table->string("email", FIELD_SIZE_DEFAULT_MAX);
			$table->string("passwd", FIELD_SIZE_PASSWD_MAX);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_tbl');
    }
};
