<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksOutOnLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_out_on_loan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->references('id')->on('books');
            $table->foreignId('student_id')->references('id')->on('students');
            $table->integer('number')->default(1);
            $table->dateTime('date_borrowed')->useCurrent();
            $table->dateTime('date_expiration')->nullable();
            $table->dateTime('date_returned')->nullable();
            $table->integer('status')->default(0);
            $table->float('amount_of_fine')->nullable();
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
        Schema::dropIfExists('books_out_on_loan');
    }
}
