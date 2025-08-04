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
            $table->bigInteger('role_id')->after('id')->default(1);
            $table->string('username')->after('role_id')->nullable();
            $table->tinyInteger('status')->default(1)->after('password');
            $table->text('photo')->default('/images/photo/no_pic.png')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role_id', 'username', 'status', 'photo']);
        });
    }
};
