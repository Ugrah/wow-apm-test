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

            $table->bigInteger('department_id')->nullable()->unsigned();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->string('manager_id')->nullable();
            // $table->foreign('manager_id')
            //     ->references('unique_id')
            //     ->on('users');

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
