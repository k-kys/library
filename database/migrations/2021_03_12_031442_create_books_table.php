<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->nullable();
            $table->string('name');
            $table->string('author')->nullable();
            $table->text('description')->nullable();
            $table->float('price')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('stock_amount')->nullable();
            $table->integer('times_borrow')->default(0);
            $table->string('image')->nullable();
            $table->softDeletes(); // cột deleted_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
