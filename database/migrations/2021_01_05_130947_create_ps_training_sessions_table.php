<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Query\Expression;

class CreatePsTrainingSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ps_training_sessions', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('description');
            $table->integer('max_users');
            $table->integer('level');
            // $table->json('training_dates')->default(new Expression('(JSON_ARRAY())'));
            $table->json('training_dates');

            $table->bigInteger('ps_skill_id')->unsigned();
            $table->foreign('ps_skill_id')
                ->references('id')
                ->on('ps_skills')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->bigInteger('trainer_id')->unsigned();
            $table->foreign('trainer_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->bigInteger('updated_by')->unsigned();
            $table->foreign('updated_by')
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
        Schema::dropIfExists('ps_training_sessions');
    }
}
