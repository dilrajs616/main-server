<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainCategoryViaLlamaTable extends Migration
{
    public function up()
    {
        Schema::create('domain_category_via_llama', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('domain_name'); // Foreign key to domain_info(domain_name)
            $table->string('category'); // String column for category
            $table->timestamp('time')->nullable(); // Nullable timestamp column
            $table->timestamps(); // created_at and updated_at columns

            // Foreign key constraint
            $table->foreign('domain_name')->references('domain_name')->on('domain_info')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('domain_category_via_llama');
    }
}