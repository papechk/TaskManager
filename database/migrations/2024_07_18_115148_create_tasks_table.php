<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute les migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $teTable) {
            $teTable->id();
            $teTable->string('tetitle');
            $teTable->longText('tedescription');
            $teTable->date('testart_date');
            $teTable->date('tedue_date');
            $teTable->time('testart_time');
            $teTable->time('teend_time');
            $teTable->string('testatus')->default('à faire');
            $teTable->string('tepriority', 20)->default('moyenne');
            $teTable->foreignId('teuser_created_by')->constrained('users')->cascadeOnDelete();
            $teTable->foreignId('teuser_assigned_to')->nullable()->constrained('users')->cascadeOnDelete();
            $teTable->timestamps();
        });
    }

    /**
     * Annule les migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};