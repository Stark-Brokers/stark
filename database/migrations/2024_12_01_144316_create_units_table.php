<?php

use App\Enums\UnitStatus;
use App\Enums\UnitType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('type')->default(UnitType::APARTMENT);
            $table->decimal('price',10,2)->default(0);
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('area')->default(0);
            $table->tinyInteger('number_bedroom')->default(0);
            $table->tinyInteger('number_bathroom')->default(0);
            $table->string('status')->default(UnitStatus::PENDING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};