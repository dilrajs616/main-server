<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDomainCategoryViaLlamaTable extends Migration
{
    public function up()
    {
        Schema::table('domain_category_via_llama', function (Blueprint $table) {
            // Add the category_id column as a foreign key
            $table->unsignedBigInteger('category_id')->after('domain_name');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // Drop the category column
            $table->dropColumn('category');
        });
    }

    public function down()
    {
        Schema::table('domain_category_via_llama', function (Blueprint $table) {
            // Reverse the changes
            $table->string('category')->after('domain_name');
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}