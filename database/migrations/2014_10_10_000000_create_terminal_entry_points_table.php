<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminalEntryPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminal_entry_points', function (Blueprint $table) {
            $table->id();
            $table->string('mavim_token');
            $table->string('mavim_entry_point');
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
        Schema::dropIfExists('terminal_entry_points');
        
        // Schema::table('terminal_entry_points', function ($table) {
        //     $table->dropSoftDeletes();
        // });
    }
}
