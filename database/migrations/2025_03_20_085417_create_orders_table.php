<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->string('order_number')->unique();
      $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
      $table->integer('quantity');
      $table->decimal('total', 15, 2);
      $table->string('name');
      $table->string('phone');
      $table->string('address');
      $table->string('address_detail')->nullable();
      $table->string('postal_code');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('orders');
  }
};
