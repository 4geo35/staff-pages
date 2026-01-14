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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string("last_name");
            $table->string("name");
            $table->string("patronymic")->nullable();

            $table->unsignedBigInteger("image_id")->nullable();

            $table->string("short")->nullable();
            $table->text("description")->nullable();
            $table->text("comment")->nullable();

            $table->unsignedBigInteger("priority")->default(0);
            $table->dateTime("published_at")->nullable();

            $table->dateTime("enable_btn")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
