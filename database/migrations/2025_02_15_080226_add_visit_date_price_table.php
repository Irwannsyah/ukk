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
        Schema::table('payment', function(Blueprint $table){
            $table->integer('ticket')->after('transaction_id');
            $table->date('visit_date')->default(now())->after('ticket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment', function(Blueprint $table){
            $table->dropColumn(['ticket', 'visit_date']);
        });
    }
};
