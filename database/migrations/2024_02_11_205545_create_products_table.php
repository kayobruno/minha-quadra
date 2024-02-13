<?php

use App\Enums\ProductType;
use App\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('merchant_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('price')->nullable();
            $table->enum('type', ProductType::all())->default(ProductType::Product->value);
            $table->integer('stock')->default(0);
            $table->enum('status', Status::all())->default(Status::Pending->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
