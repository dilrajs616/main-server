<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountTable extends Migration
{
    public function up()
    {
        Schema::create('count', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->integer('total_rows')->default(0); // Column to store the total number of rows
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('count');
    }
}
