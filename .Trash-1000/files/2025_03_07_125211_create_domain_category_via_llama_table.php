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
            $table->unsignedBigInteger('category_id');
            $table->timestamp('time')->useCurrent();
            $table->timestamps();

            // Foreign key reference to category_groups
            $table->foreign('category_id')
                ->references('id')
                ->on('category_groups')
                ->onDelete('cascade'); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domain_category_via_llama');
    }
};
