<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountColumnToDomainInfoTable extends Migration
{
    public function up()
    {
        Schema::table('domain_info', function (Blueprint $table) {
            $table->integer('count')->nullable()->after('status'); // Add the count column
        });
    }

    public function down()
    {
        Schema::table('domain_info', function (Blueprint $table) {
            $table->dropColumn('count'); // Remove the count column
        });
    }
}