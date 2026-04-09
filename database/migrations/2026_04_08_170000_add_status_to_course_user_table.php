<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_user', function (Blueprint $table) {
            $table->string('status')->default('approved')->after('course_id');
            $table->index(['course_id', 'status']);
        });

        DB::table('course_user')->whereNull('status')->update(['status' => 'approved']);
    }

    public function down(): void
    {
        Schema::table('course_user', function (Blueprint $table) {
            $table->dropIndex(['course_id', 'status']);
            $table->dropColumn('status');
        });
    }
};

