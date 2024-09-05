<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIdUserAsPrimaryKeyInUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus primary key yang ada (jika ada)
            $table->dropPrimary('users_id_primary');

            // Mengubah kolom id_user menjadi primary key
            $table->dropColumn('id'); // Jika kolom id lama ada
            $table->string('id_user')->primary()->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengembalikan perubahan jika migrasi dibatalkan
            $table->dropPrimary('id_user');
            $table->increments('id'); // Menambahkan kembali kolom id
        });
    }
}
