<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('real_urls', function (Blueprint $table) {
            $table->id();
            $table->string('url_host')->nullable();
            $table->string('state')->nullable();
            $table->string('isActive')->nullable();
            $table->string('security')->nullable(); // From BlackLists 
            $table->string('favIcon')->nullable();
            $table->string('stateForSchedule')->nullable(); // Waiting to be Scanned Or not?
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('real_urls');
    }
};
