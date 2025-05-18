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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->uuid('id')->change();
            $table->string('username')->unique()->after('id');
            $table->string('fullname')->unique()->after('username');
            $table->enum('role', ['staff', 'admin'])->default('admin')->after('email');
            $table->uuid('id_department')->after('role');
            $table->string('position')->after('id_department');
            $table->integer('phone_number')->after( 'position' );
            $table -> string ('image')->nullable()->after('phone_number');
        });

        Schema::table('users', function (Blueprint $t) {
            $t->foreign('id_department')          // Menetapkan kolom 'id_department' sebagai foreign key
              ->references('id')                  // Foreign key ini merujuk ke kolom 'id'
              ->on('departments')                 // Pada tabel 'departments'
              ->onDelete('cascade');              // Jika data di departments dihapus, maka data terkait di users juga ikut terhapus (cascade delete)
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');

        Schema::table('users', function (Blueprint $t) {
            // 1. Hapus foreign key constraint terlebih dahulu sebelum menghapus kolom yang terkait
            $t->dropForeign(['users_id_department_foreign']);

            // 2. Hapus kolom-kolom baru yang sebelumnya ditambahkan di migration up()
            $t->dropColumn(['username', 'fullname', 'role', 'id_department', 'position', 'phone_number', 'image']);

            // 3. Ubah kembali tipe kolom id menjadi unsignedBigInteger (bigIncrements)
            $t->unsignedBigInteger('id')->change();

            // 4. Tambahkan kembali kolom name yang sebelumnya dihapus, letakkan setelah email_verified_at
            $t->string('name')->after('email_verified_at');
        });
    }
};
