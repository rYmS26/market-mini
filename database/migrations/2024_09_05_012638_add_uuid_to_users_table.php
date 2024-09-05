<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUuidToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom primary key saat ini (jika ada) agar bisa diganti dengan UUID
            $table->dropPrimary('id');

            // Menambahkan kolom id_user sebagai UUID dan primary key
            $table->uuid('id_user')->primary()->unique()->first();

            // Hapus kolom id (opsional, jika ada kolom lain seperti id auto increment yang ingin diganti dengan UUID)
            $table->dropColumn('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kembali kolom id auto increment jika di-rollback
            $table->bigIncrements('id')->first();
            
            // Hapus UUID
            $table->dropColumn('id_user');
        });
    }
}
