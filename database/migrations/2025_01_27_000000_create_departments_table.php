<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // Insert default departments
        DB::table('departments')->insert([
            ['name' => 'Admin', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sales', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Quality', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CCV', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Billing', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ChargeBack', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Changes', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};