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
        
        Schema::table('appointments', function (Blueprint $table) {
            // Change the columns to datetime
            $table->datetime('startdate')->change();
            $table->datetime('enddate')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Revert the columns back to their original type
            $table->date('startdate')->change();
            $table->date('enddate')->change();
        });
    }
};
