<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUserIdToUuidInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom id_user yang lama, jika ada
            $table->dropColumn('id_user');

            // Menambahkan kolom UUID baru
            $table->uuid('id_user')->primary();
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
            // Menghapus kolom UUID
            $table->dropColumn('id_user');

            // Mengembalikan kolom id_user sebagai integer auto increment
            $table->bigIncrements('id_user')->primary();
        });
    }
}
