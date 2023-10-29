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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('createdAt')->useCurrent();
            $table->boolean('status')->default(1);
        });
        Schema::create('item', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('createdAt')->useCurrent();
            $table->boolean('status')->default(1);
            $table->string('description')->nullable();
            $table->decimal('pricePurch', 8,2);
            $table->decimal('priceSale',8,2);
            $table->decimal('percent',8,2);
            $table->integer('count');
            $table->string('code');
            $table->string('codeHelias');
            $table->unsignedBigInteger('catId');

            $table->foreign('catId')->references('id')->on('category');

        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
