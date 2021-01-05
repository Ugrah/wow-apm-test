<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->string('name');

            $table->string('firstname');
            $table->string('lastname');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');


            $table->string('username')->unique();
            $table->string('unique_id')->unique();

            // $table->bigInteger('user_category_id')->nullable()->unsigned();
            // $table->foreign('user_category_id')
            //     ->references('id')
            //     ->on('user_categories')
            //     ->onDelete('restrict')
            //     ->onUpdate('restrict');

            $table->bigInteger('manager_id')->nullable()->unsigned();
            // $table->foreign('manager_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('restrict')
            //     ->onUpdate('restrict');

            $table->bigInteger('terminal_id')->nullable()->unsigned();
            $table->foreign('terminal_id')
                ->references('id')
                ->on('terminals')
                ->onDelete('restrict')
                ->onUpdate('restrict');


            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
