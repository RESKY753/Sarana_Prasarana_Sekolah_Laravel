<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
Schema::table('progres_aspirasi', function (Blueprint $table) {
$table->text('umpan_balik')->nullable()->change();
});
}

public function down(): void
{
Schema::table('progres_aspirasi', function (Blueprint $table) {
$table->text('umpan_balik')->nullable(false)->change();
});
}
};