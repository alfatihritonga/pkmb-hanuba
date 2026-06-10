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
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('birth_place')->after('name')->nullable();
            $table->date('birth_date')->after('birth_place')->nullable();
            $table->string('religion')->after('gender')->nullable();
            $table->text('address')->after('phone')->nullable();
            $table->enum('status', ['active', 'inactive'])->after('address')->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('birth_place');
            $table->dropColumn('birth_date');
            $table->dropColumn('religion');
            $table->dropColumn('address');
            $table->dropColumn('status');
        });
    }
};
