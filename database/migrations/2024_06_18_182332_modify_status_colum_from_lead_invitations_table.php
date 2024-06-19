<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lead_invitations', function (Blueprint $table) {
            DB::statement("ALTER TABLE lead_invitations MODIFY COLUMN status ENUM('Pending', 'Accepted', 'Declined', 'Expired') NOT NULL DEFAULT 'Pending'");
            // $table->enum('status', ['Pending', 'Accepted', 'Declined', 'Expired'])->change();
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lead_invitations', function (Blueprint $table) {
            $table->enum('status', ['Pending', 'Accepted', 'Declined', 'Expired'])->default('Pending');
            //
        });
    }
};
