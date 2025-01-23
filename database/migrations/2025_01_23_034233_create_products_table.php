<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID: uint, autoincrement
            $table->string('article', 255)->unique(); // ARTICLE: varchar(255), unique index
            $table->string('name', 255); // NAME: varchar(255)
            $table->enum('status', ['available', 'unavailable']); // STATUS: varchar(255), "available" | "unavailable"
            $table->jsonb('data')->nullable(); // DATA: jsonb (например, Color и Size)
            $table->timestamps(); // timestamps
            $table->softDeletes(); // soft deletes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
