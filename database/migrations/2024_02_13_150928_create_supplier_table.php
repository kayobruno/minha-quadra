<?php

use App\Enums\DocumentType;
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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('merchant_id');
            $table->string('name');
            $table->text('trade_name')->nullable();
            $table->string('document');
            $table->string('tax_registration')->nullable();
            $table->enum('type', DocumentType::all());
            $table->enum('status', Status::all())->default(Status::Pending->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
