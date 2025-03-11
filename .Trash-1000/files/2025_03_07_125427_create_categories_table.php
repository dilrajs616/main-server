<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('group_id'); // Reference to category_groups
            $table->timestamps();

            // Foreign key reference to category_groups
            $table->foreign('group_id')
                ->references('id')
                ->on('category_groups')
                ->onDelete('cascade'); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
