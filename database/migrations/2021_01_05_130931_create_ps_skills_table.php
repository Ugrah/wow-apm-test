<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ps_skills', function (Blueprint $table) {
            $table->id();

            $table->string('skill_name');
            $table->string('url_link');
            $table->string('logo_filename')->nullable();

            $table->bigInteger('wow_category_id')->nullable()->unsigned();
            $table->foreign('wow_category_id')
                ->references('id')
                ->on('wow_categories')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('ps_skills');
    }
}
