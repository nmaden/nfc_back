<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_links', function (Blueprint $table) {
            $table->boolean('show')->default(false)->nullable();
        });
        Schema::table('client_phones', function (Blueprint $table) {
            $table->boolean('show')->default(false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_links', function (Blueprint $table) {
            $table->dropColumn('show')->default(false)->nullable();
        });
        Schema::table('client_phones', function (Blueprint $table) {
            $table->dropColumn('show')->default(false)->nullable();
        });
    }
}
