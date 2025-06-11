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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_status_id')->nullable();
            //$table->unsignedBigInteger('note_id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('company_name')->nullable(); // maybe we should delete this?
            $table->string('phone');
            //$table->string('created_by');
            $table->timestamps();

            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_status_id')->references('id')->on('client_statuses')->onDelete('cascade');
            //$table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
