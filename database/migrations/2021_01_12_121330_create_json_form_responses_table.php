<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJsonFormResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('json_form_responses', function (Blueprint $table) {
            $table->id();

            $table->json('data');

            $table->bigInteger('json_form_id')->unsigned();
            $table->foreign('json_form_id')
                ->references('id')
                ->on('json_forms')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->boolean('approved')->default(false);

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
        Schema::dropIfExists('json_form_responses');
    }
}
