<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained();
            $table->foreignId('member_id')->constrained();
            $table->date('borrow_date');
            $table->date('return_date');
            $table->date('actual_return_date')->nullable();
            $table->decimal('fine', 10, 2)->default(0);
            $table->string('status')->default('borrowed'); // borrowed, returned, overdue
            $table->text('notes')->nullable();
            $table->foreignId('issued_by')->nullable()->constrained('users');
            $table->foreignId('received_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('borrows');
    }
}