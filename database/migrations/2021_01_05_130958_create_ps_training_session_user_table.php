<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsTrainingSessionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ps_training_session_user', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('training_session_id')->unsigned();
            $table->foreign('training_session_id')
                ->references('id')
                ->on('ps_training_sessions')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->integer('registered_for_training');
            $table->timestamp('registered_for_training_at');
            $table->boolean('acquired')->default(false);
            $table->timestamp('acquired_at')->nullable();

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
        Schema::dropIfExists('ps_training_session_user');
    }
}
