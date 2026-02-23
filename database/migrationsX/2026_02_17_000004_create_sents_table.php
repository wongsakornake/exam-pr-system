<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_target_id')->constrained()->onDelete('cascade');
            $table->foreignId('mail_marketing_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sents');
    }
};
