<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // tipe datanya = bigint dan otomatis autoincrement serta nama fieldnya adalah id
            $table->string('name'); // tipe data string = varchar nama fieldnya adalah name
            $table->string('email')->unique(); // unique => tidak boleh ada isi/value/nilainya yg sama antar satu data degn data yg lain
            $table->timestamp('email_verified_at')->nullable(); // tipe data timestamp (2022-07-31 21:10:47)
            $table->string('password');
            $table->enum('level', ['Admin','Kasir'] ); // enum tipe data yg berupa pilihan
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
