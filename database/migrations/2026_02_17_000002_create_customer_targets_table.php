<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_targets', function (Blueprint $table) {
            $table->id();
            $table->string('area')->nullable();
            $table->string('destination_organization_name')->nullable();
            $table->string('department')->nullable();
            $table->string('name');
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('display_name')->nullable();
            $table->string('category')->nullable();
            $table->string('opt_in_out')->default('opt_in');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_targets');
    }
};
