<?php

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
        Schema::create('incomings', function (Blueprint $table) {
            $table->id();
            $table->string('issue_number')->unique();
            $table->date('issue_date');
            $table->foreignId('from_contact_id')->nullable()->constrained('contacts')->nullOnDelete();
            $table->string('from')->nullable();
            $table->foreignId('follow_up_id')->nullable()->constrained('outgoings')->nullOnDelete();
            $table->json('attachments')->nullable();
            $table->string('document_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomings');
    }
};
