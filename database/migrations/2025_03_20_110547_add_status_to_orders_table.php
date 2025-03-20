<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::table('orders', function (Blueprint $table) {
      $table->string('status')->default('pending')->after('total'); // Tambahkan kolom status
    });
  }

  public function down()
  {
    Schema::table('orders', function (Blueprint $table) {
      $table->dropColumn('status'); // Hapus kolom jika rollback
    });
  }
};
