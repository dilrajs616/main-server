<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkedDomainsTable extends Migration
{
    public function up()
    {
        Schema::create('linked_domains', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('visited_domain'); // Foreign key to domain_info(domain_name)
            $table->string('connected_domain'); // Foreign key to domain_info(domain_name)
            $table->timestamps(); // created_at and updated_at columns

            // Foreign key constraints
            $table->foreign('visited_domain')->references('domain_name')->on('domain_info')->onDelete('cascade');
            $table->foreign('connected_domain')->references('domain_name')->on('domain_info')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('linked_domains');
    }
}