<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $dupes = DB::table('test_results')
            ->select('user_id', 'test_id')
            ->groupBy('user_id', 'test_id')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($dupes as $d) {
            $keep = DB::table('test_results')
                ->where('user_id', $d->user_id)
                ->where('test_id', $d->test_id)
                ->orderByDesc('score')
                ->orderByDesc('id')
                ->first();

            if ($keep) {
                DB::table('test_results')
                    ->where('user_id', $d->user_id)
                    ->where('test_id', $d->test_id)
                    ->where('id', '!=', $keep->id)
                    ->delete();
            }
        }

        Schema::table('test_results', function (Blueprint $table) {
            $table->unique(['user_id', 'test_id']);
        });
    }

    public function down(): void
    {
        Schema::table('test_results', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'test_id']);
        });
    }
};

