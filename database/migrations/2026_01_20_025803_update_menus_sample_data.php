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
        \App\Models\Menu::where('name', 'Ikan Bakar Jimbaran')->update(['category' => 'Bakar', 'status' => 'Tersedia']);
        \App\Models\Menu::where('name', 'Ikan Bakar Padang')->update(['category' => 'Bakar', 'status' => 'Tersedia']);
        \App\Models\Menu::where('name', 'Ikan Bakar Manado')->update(['category' => 'Bakar', 'status' => 'Tersedia']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
