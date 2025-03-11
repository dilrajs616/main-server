<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainInfoTable extends Migration
{
    public function up()
    {
        Schema::create('domain_info', function (Blueprint $table) {
            $table->string('domain_name')->primary(); // Primary key
            $table->boolean('is_subdomain'); // Boolean column
            $table->string('main_domain')->nullable(); // Nullable string column
            $table->enum('status', ['inprogress', 'finished'])->default('inprogress'); // Enum column
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('domain_info');
    }
}