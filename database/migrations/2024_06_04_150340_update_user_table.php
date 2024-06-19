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
            $table->string('national_number')->after('id')->nullable;
            $table->string('country')->after('national_number')->nullable;
            $table->text('roles_name')->after('password')->default('user');
            $table->string('status',10)->after('roles_name')->default('مفعل');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('national_number');
            $table->dropColumn('roles_name');
            $table->dropColumn('status');
        });
    }
};
