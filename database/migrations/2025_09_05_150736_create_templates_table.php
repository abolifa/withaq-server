<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('greeting')->nullable();
            $table->string('closing')->nullable();
            $table->string('position')->nullable();
            $table->string('commissioner')->nullable();
            $table->string('signature')->nullable();
            $table->string('stamp')->nullable();

            $table->boolean('show_position')->default(false);
            $table->boolean('show_commissioner')->default(false);
            $table->boolean('show_signature')->default(false);
            $table->boolean('show_stamp')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
