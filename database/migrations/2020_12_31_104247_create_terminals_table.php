<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('matricule');
            $table->string('code');

            $table->bigInteger('terminal_entry_point_id')->nullable()->unsigned();
			$table->foreign('terminal_entry_point_id')
				  ->references('id')
				  ->on('terminal_entry_points')
				  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->boolean('status')->default(true);
            $table->timestamps();

            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terminals');

        // Schema::table('terminals', function ($table) {
        //     $table->dropForeign('terminals_terminal_entry_point_id_foreign');
        //     $table->dropSoftDeletes();
        // });
    }
}
