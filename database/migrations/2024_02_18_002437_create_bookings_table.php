<?php

use App\Enums\BookingStatus;
use App\Enums\Sport;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('merchant_id');
            $table->bigInteger('customer_id');
            $table->bigInteger('court_id');
            $table->enum('sport', Sport::all());
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->integer('total_hours');
            $table->text('note')->nullable();
            $table->enum('status', BookingStatus::all())->default(BookingStatus::Pending->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
