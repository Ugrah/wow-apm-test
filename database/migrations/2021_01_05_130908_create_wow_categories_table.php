<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWowCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wow_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url_link');
            $table->string('logo_filename');

            $table->bigInteger('parent_id')->nullable()->unsigned();
            $table->foreign('parent_id')
                ->references('id')
                ->on('wow_categories')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wow_categories');
    }
}
