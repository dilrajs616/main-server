<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('history_table', function (Blueprint $table) {
            $table->id('record_id'); // Primary key
            $table->string('domain_id'); // Foreign key to domain_info(domain_name)
            $table->boolean('is_subdomain'); // Boolean column
            $table->string('main_domain')->nullable(); // Nullable string column
            $table->string('redirected_to')->nullable(); // Nullable string column
            $table->string('country')->nullable(); // Nullable string column
            $table->string('language')->nullable(); // Nullable string column
            $table->timestamp('time_of_scraping')->nullable(); // Nullable timestamp column
            $table->boolean('is_changed')->default(false); // Boolean column with default value
            $table->timestamps(); // created_at and updated_at columns

            // Foreign key constraint
            $table->foreign('domain_id')->references('domain_name')->on('domain_info')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('history_table');
    }
}