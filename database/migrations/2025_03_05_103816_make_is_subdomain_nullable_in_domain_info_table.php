<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeIsSubdomainNullableInDomainInfoTable extends Migration
{
    public function up()
    {
        Schema::table('domain_info', function (Blueprint $table) {
            $table->boolean('is_subdomain')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('domain_info', function (Blueprint $table) {
            $table->boolean('is_subdomain')->nullable(false)->change();
        });
    }
}