<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('domain_category_via_llama', function (Blueprint $table) {
            $table->id();
            $table->string('domain_name')->index();
            $table->foreignId('category_id')->constrained('category_groups')->onDelete('cascade'); // Reference category_groups
            $table->timestamp('time');
            $table->timestamps();
        });

        Schema::create('domain_category_via_zeroshot', function (Blueprint $table) {
            $table->id();
            $table->string('domain_name')->index();
            $table->foreignId('category_id')->constrained('category_groups')->onDelete('cascade'); // Reference category_groups
            $table->timestamp('time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domain_category_via_llama');
        Schema::dropIfExists('domain_category_via_zeroshot');
    }
};
